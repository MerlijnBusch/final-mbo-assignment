<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

/**
 * @property mixed|string name
 * @property mixed|string type
 * @property mixed|string description
 * @property HigherOrderBuilderProxy|mixed event_id
 * @property Carbon|CarbonInterface|mixed date
 * @property bool|mixed active
 */
class Item extends Model
{

    public function getAllItemTypes() {
        try {
            $reflectionClass = new ReflectionClass($this);
            return $reflectionClass->getConstants();
        } catch (\ReflectionException $e) {
            abort(500, "Internal Server Error");
        }
    }

    public const __KEYNOTES__ = 'keynotes';
    public const __NONE__ = 'none';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'description',
        'event_id',
        'date',
        'active',
    ];

    public function program(){

        return $this->belongsTo('App\Program');

    }
}
