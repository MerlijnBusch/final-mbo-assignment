<template>
    <div class="profile-container" v-if="!!data">
        <div class="flex-wrapper profile-top" >
            <h1>{{data.name}}'s profiel</h1>
        </div>
        <div class="form-profile-edit">
            <div class="mobile-wrapper flex-grid column-desktop-full column-tablet-12">
                <div class="column-desktop-4 column-tablet-12 column-mobile-12 profile-border profile-main-wrapper">
                    <div class="profile-foto" :style="(!!data.profile && !!data.profile.image)? {backgroundImage: 'url('+data.profile.image+')'} : ''"/>
                    <div class="profile-main">
                        <p class="profile-name">
                            {{data.name}}
                        </p>
                        <p class="profile-role">
                            {{data.role.role_name}}
                        </p>
                        <template v-if="!!data.profile">
                        <div v-if="!!company && role_name !== 'Werkzoekende'">
                            <p class="profile-company">
                                Bedrijf
                            </p>
                            <p class="profile-company-name">
                                {{company}}
                            </p>
                        </div>
                        <div v-if="!!data.profile && !!data.profile.comp_function && role_name !== 'Werkzoekende'">
                            <p class="profile-function">
                                Functie
                            </p>
                            <p class="profile-company-name">
                                {{ comp_function }}
                            </p>
                        </div>
                        <hr class="profile-line-phone">
                        <button v-if="!!data && !!data.profile && !!data.profile.cv && data.profile.cv.length > 0 && data.role.role_name === 'Werkzoekende'" class="download-cv"
                                @click.prevent="showCV">
                            bekijk CV
                        </button>
                        </template>
                    </div>
                </div>
                <div class="column-desktop-8 column-tablet-12 column-mobile-12 profile-about-mobile profile-row-right" v-if="!!data.profile">
                    <div class="profile-border profile-about">
                        <div class="profile-about-border">
                            <p class="profile-about-title">
                                Vertel over jezelf
                            </p>
                            <p class="profile-about-description">
                                {{data.profile.about}}
                            </p>
                        </div>
                    </div>
                    <div class="profile-border profile-contact profile-border">
                        <p class="contact-title">
                            Contact
                        </p>
                        <div class="contact-logo">
                            <div>
                                <a v-if="!!data.profile.linkedin && data.profile.linkedin.length > 5" :href="data.profile.linkedin" target="_blank">
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                    >
                                        <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 8c0 .557-.447 1.008-1 1.008s-1-.45-1-1.008c0-.557.447-1.008 1-1.008s1 .452 1 1.008zm0 2h-2v6h2v-6zm3 0h-2v6h2v-2.861c0-1.722 2.002-1.881 2.002 0v2.861h1.998v-3.359c0-3.284-3.128-3.164-4-1.548v-1.093z"/>
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <a v-if="!!data.profile.facebook && data.profile.facebook.length > 5" :href="data.profile.facebook">
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                    >
                                        <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 10h-2v2h2v6h3v-6h1.82l.18-2h-2v-.833c0-.478.096-.667.558-.667h1.442v-2.5h-2.404c-1.798 0-2.596.792-2.596 2.308v1.692z"/>
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <a v-if="!!data.profile.twitter && data.profile.twitter.length > 5"  :href="data.profile.twitter">
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                    >
                                        <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6.5 8.778c-.441.196-.916.328-1.414.388.509-.305.898-.787 1.083-1.362-.476.282-1.003.487-1.564.597-.448-.479-1.089-.778-1.796-.778-1.59 0-2.758 1.483-2.399 3.023-2.045-.103-3.86-1.083-5.074-2.572-.645 1.106-.334 2.554.762 3.287-.403-.013-.782-.124-1.114-.308-.027 1.14.791 2.207 1.975 2.445-.346.094-.726.116-1.112.042.313.978 1.224 1.689 2.3 1.709-1.037.812-2.34 1.175-3.647 1.021 1.09.699 2.383 1.106 3.773 1.106 4.572 0 7.154-3.861 6.998-7.324.482-.346.899-.78 1.229-1.274z"/>
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <a v-if="!!data.profile.contact_email && data.profile.contact_email.length > 5"  :href="'mailto:' + data.profile.contact_email">
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                    >
                                        <path d="M12 2.02c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 12.55l-5.992-4.57h11.983l-5.991 4.57zm0 1.288l-6-4.629v6.771h12v-6.771l-6 4.629z"/>
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <a v-if="!!data.profile.phone_number && data.profile.phone_number.length > 5"  :href="'tel:' + data.profile.phone_number">
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                    >
                                        <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.5 17.311l-1.76-3.397-1.032.505c-1.12.543-3.4-3.91-2.305-4.497l1.042-.513-1.747-3.409-1.053.52c-3.601 1.877 2.117 12.991 5.8 11.308l1.055-.517z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div ref="cvHolder" class="cv-holder" @click="emptyCV" />
    </div>
</template>

<script>
    import API from '../Api';
    import PDFJS from 'pdfjs-dist';
    import {bytesToBase64} from 'byte-base64';

    export default {
        name: 'Profile',
        data() {
            return {
                data: null,
                company: 'COMPANY',
                company_function: 'COMPANY-FUNCTION',
                role_name: 'Werkzoekende',
            }
        },
        methods: {
            showCV () {
                let numPages = 0;
                const _this = this;
                const typedArray = Uint8Array.from(atob(this.data.profile.cv), c => c.charCodeAt(0));
                PDFJS.getDocument(typedArray).then(function (pdf) {
                    numPages = pdf.numPages;
                    for (let i = 0; i <= numPages; i++) {
                        pdf.getPage(i).then(handlePages);
                    }
                });

                const handlePages = function (page) {
                    const viewport = page.getViewport(1);
                    const canvas = document.createElement('canvas');
                    canvas.style.display = 'block';
                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    page.render({ canvasContext: context, viewport: viewport });
                    _this.$refs.cvHolder.appendChild(canvas);
                };
            },
            emptyCV () {
                this.$refs.cvHolder.innerHTML = '';
            },
        },
        async mounted() {
            const res = await API.get('/api/profile/visit/' + this.$route.params.id);
            this.data = res.data;
        },
    };

</script>