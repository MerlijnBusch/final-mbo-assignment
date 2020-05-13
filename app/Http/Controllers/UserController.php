<?php

namespace App\Http\Controllers;

use App\Permissions;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function updatetoken()
    {
        $user = User::find(Auth::id());
        $user->api_token = Hash::make(Str::random(120), [
            'memory' => 1024,
            'time' => 2,
            'threads' => 2,
        ]);
        $user->api_token_expired_date = Carbon::now()->addHour();
        $user->update();

        return response()->json(['message' => $user->api_token], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request){

        $validator = Validator::make($request->all(), [
            'search' => ['string']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::query()
            ->where('name','LIKE','%' . $request->search . '%')
            ->orWhere('email','LIKE','%' . $request->search . '%')
            ->with('profile')
            ->get();

        return response()->json(['message' => $user], 200);
    }

    /**
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function permissions(){

        $this->authorize('write', Role::class);

        $permissions = new Permissions;
        return response()->json(['message' => $permissions->getAllPermissions()], 200);

    }
}