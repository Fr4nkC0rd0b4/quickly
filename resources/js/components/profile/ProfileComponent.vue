<template>
    <div class="container-fluid">
        <header-component title="Perfil"></header-component>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="profile-user-box card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="media">
                                    <span class="float-left m-2 mr-4">
                                        <img :src="/storage/+user.avatar" alt="user.name" class="rounded-circle img-thumbnail" style="height: 100px;">
                                    </span>
                                    <div class="media-body">
                                        <h4 class="mt-1 mb-1">{{ user.name }}</h4>
                                        <p class="font-13 text-dark-50"> Authorised Brand Seller</p>
                                        <ul class="mb-0 list-inline">
                                            <li class="list-inline-item mr-3">
                                                <h5 class="mb-1">254</h5>
                                                <p class="mb-0 font-13 text-dark-50">Número de Envios</p>
                                            </li>
                                            <li class="list-inline-item">
                                                <h5 class="mb-1">54</h5>
                                                <p class="mb-0 font-13 text-dark-50">Número de Entregas</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="text-center mt-sm-0 mt-3 text-sm-right">
                                    <router-link to="/vue/profile/edit" type="button" class="btn btn-primary">
                                        <b-icon-pencil-square></b-icon-pencil-square>
                                        Editar Perfil
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3">Info del Quickero</h4>
                        <p class="text-muted font-13">Hye, I’m Michael Franklin residing in this beautiful world. I create websites and mobile apps with great UX and UI design. I have done work with big companies like Nokia, Google and Yahoo. Meet me or Contact me for any queries. One Extra line for filling space. Fill as many you want.</p>
                        <hr>
                        <div class="text-left">
                            <p class="text-muted">
                                <strong>Nombre :</strong> <span class="ml-2">{{ user.name }}</span>
                            </p>
                            <p class="text-muted">
                                <strong>Celular :</strong><span class="ml-2">(+12) 123 1234 567</span>
                            </p>
                            <p class="text-muted">
                                <strong>Email :</strong> <span class="ml-2">{{ user.email }}</span>
                            </p>
                            <p class="text-muted">
                                <strong>Ubicación :</strong> <span class="ml-2">USA</span>
                            </p>
                            <p class="text-muted">
                                <strong>Idiomas :</strong><span class="ml-2"> English, German, Spanish </span>
                            </p>
                            <p class="text-muted mb-0">
                                <strong>Otras redes :</strong>
                                <a class="d-inline-block ml-2 text-muted" title="" data-placement="top" data-toggle="tooltip" href="/" data-original-title="Facebook">
                                    <span data-feather="facebook"></span>
                                </a>
                                <a class="d-inline-block ml-2 text-muted" title="" data-placement="top" data-toggle="tooltip" href="/" data-original-title="Twitter">
                                    <span data-feather="twitter"></span>
                                </a>
                                <a class="d-inline-block ml-2 text-muted" title="" data-placement="top" data-toggle="tooltip" href="/" data-original-title="Instagram">
                                    <span data-feather="instagram"></span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let user = document.head.querySelector('meta[name="user"]');

    export default {
        computed: {
            user(){
                return JSON.parse(user.content);
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
