<template>
    <div class="container-fluid">
        <header-component title="Perfil"></header-component>

        <div style="text-align: left;" v-if="result.message!=''" :class="result.alert" class="alert alert-dismissible fade show" role="alert">
        {{ result.message }}
            <button type="button" @click="result={message:'',alert:''}" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="card text-center">
                    <div class="card-body">
                        <img :src="/storage/+user.avatar" :alt="user.name" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                        <h4 class="mb-0 mt-2">{{ user.name }}</h4>
                        <p class="text-muted font-14">{{ user.role_id.role }}</p>

                        <button type="button" class="btn btn-success btn-sm mb-2">Follow</button>
                        <button type="button" class="btn btn-danger btn-sm mb-2">Message</button>

                        <div class="text-left mt-3">
                            <h4 class="font-13 text-uppercase">Mis Datos Personales</h4>
                            <p class="text-muted font-13 mb-3">
                                Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the
                                1500s, when an unknown printer took a galley of type.
                            </p>
                            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{ user.name }}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Dni :</strong><span class="ml-2">{{ user.dni }}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ user.email }}</span></p>

                            <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">USA</span></p>
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col-->

            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                            <li class="nav-item">
                                <a href="#personal_info" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                                    Mis Datos Personales
                                </a>
                            </li>
                            <li class="nav-item">
                                <a @click="validateState" href="#address" data-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                    Mis direcciones
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#payment_methods" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                    Mis métodos de pago
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="personal_info">
                                <form id="form">
                                    <input type="hidden" name="id" :value="user.id">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b-form-group class="col-sm" id="name-input" label="Nombre" label-for="name">
                                                <b-form-input
                                                    id="name"
                                                    name="name"
                                                    v-model="$v.user.name.$model"
                                                    :state="validateState('name')"
                                                    aria-describedby="live-name-feedback"
                                                ></b-form-input>

                                                <b-form-invalid-feedback id="live-name-feedback">
                                                    Este campo es requerido.
                                                </b-form-invalid-feedback>
                                            </b-form-group>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <b-form-group class="col-sm" id="dni-input" label="DNI" label-for="dni">
                                                <b-form-input
                                                    id="dni"
                                                    name="dni"
                                                    v-model="$v.user.dni.$model"
                                                    :state="validateState('dni')"
                                                    aria-describedby="live-dni-feedback"
                                                ></b-form-input>

                                                <b-form-invalid-feedback id="live-dni-feedback">
                                                    Este campo es requerido.
                                                </b-form-invalid-feedback>
                                            </b-form-group>
                                        </div>
                                    </div> <!-- end row -->

                                    <!-- <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="userbio">Bio</label>
                                                <textarea class="form-control" id="userbio" rows="4" placeholder="Write something..."></textarea>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <b-form-group class="col-sm" id="email-input" label="Correo" label-for="email">
                                                <b-form-input
                                                    id="email"
                                                    name="email"
                                                    v-model="$v.user.email.$model"
                                                    :state="validateState('email')"
                                                    aria-describedby="live-email-feedback"
                                                ></b-form-input>

                                                <b-form-invalid-feedback id="live-email-feedback">
                                                    Debe ingresar un correo valido.
                                                </b-form-invalid-feedback>
                                            </b-form-group>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <b-form-group class="col-sm" id="password-input" label="Contraseña" label-for="password">
                                                <b-form-input
                                                    id="password"
                                                    name="password"
                                                    v-model="$v.user.password.$model"
                                                    :state="validateState('password')"
                                                    aria-describedby="live-password-feedback"
                                                ></b-form-input>

                                                <b-form-invalid-feedback id="live-password-feedback">
                                                    Este campo es requerido.
                                                </b-form-invalid-feedback>
                                            </b-form-group>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->

                                    <!-- <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i> Company Info</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="companyname">Company Name</label>
                                                <input type="text" class="form-control" id="companyname" placeholder="Enter company name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cwebsite">Website</label>
                                                <input type="text" class="form-control" id="cwebsite" placeholder="Enter website url">
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth mr-1"></i> Social</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="social-fb">Facebook</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="mdi mdi-facebook"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="social-fb" placeholder="Url">
                                                </div>
                                            </div>
                                        </div>
                                    </div> --> <!-- end row -->
                                </form>
                            </div>
                            <!-- end tab-pane -->

                            <div class="tab-pane show" id="address">
                                <table class="table table-sm table-striped table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Pais</th>
                                            <th>Departamento</th>
                                            <th>Ciudad</th>
                                            <th>Dirección</th>
                                            <th>Barrio</th>
                                            <th>Principal</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="address in info.locations">
                                            <td>{{ address.country }}</td>
                                            <td>{{ address.state }}</td>
                                            <td>{{ address.city }}</td>
                                            <td>{{ address.address }}</td>
                                            <td>{{ address.neighborhood }}</td>
                                            <td>
                                                <!-- Switch-->
                                                <div>
                                                    <input v-if="address.is_main === 1" type="checkbox" name="is_main" :id="'switch'+address.id" checked data-switch="success" @click="onlyOne(this)">
                                                    <input v-else type="checkbox" name="is_main" :id="'switch'+address.id" data-switch="success" @click="onlyOne(this)">
                                                    <label :for="'switch'+address.id" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                                </div>
                                            </td>
                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                                <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <div v-for="address in info.locations" class="col-xl-6">
                                    <div class="ribbon-box card" role="button">
                                        <div class="card-body">
                                            <div class="ribbon ribbon-primary float-left">
                                                <b-icon-person></b-icon-person>
                                                {{ address.country }}
                                            </div>
                                            <h5 class="text-primary float-right mt-0">
                                                {{ address.state }}
                                            </h5>
                                            <div class="ribbon-content">
                                                <p class="mb-0">De {{ address.city }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <!-- end address content-->

                            <div class="tab-pane" id="payment_methods">
                                <table class="table table-sm table-striped table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Propietario</th>
                                            <th>Tipo</th>
                                            <th>Franquicia</th>
                                            <th>Número</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="card in info.payment_methods">
                                            <td>{{ card.name_owner }} {{ card.last_name_owner }} </td>
                                            <td>{{ card.card_type }}</td>
                                            <td>Franquicia</td>
                                            <td>{{ card.card_number }}</td>
                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <b-icon-arrow-up></b-icon-arrow-up></a>
                                                <a href="jascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end payment_methods content-->
                            <div class="text-right">
                                <button v-if="loading" slot="finish" type="submit" class="btn btn-success mt-2">
                                    <scale-loader :loading="loading" :height="height"></scale-loader>
                                </button>
                                <button v-else type="submit" @click="updateProfile" class="btn btn-success mt-2">Guardar</button>
                            </div>
                        </div> <!-- end tab-content -->
                    </div> <!-- end card body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
    </div>
</template>

<script>
    let auth_user = document.head.querySelector('meta[name="user"]');
    import { required, integer, email } from "vuelidate/lib/validators";

    export default {
        mounted() {
            this.getUserInfo();
        },
        data() {
            return {
                user: JSON.parse(auth_user.content),
                info: [],
                result: {message:'',alert:''},
                loading: false,
                height: '10px',
                alerta: ''
            }
        },
        validations: {
            user: {
                name: { required },
                dni: { required, integer },
                email: { required, email},
                password: { required }
            }      
        },
        methods: {
            getUserInfo() {
                axios.get('/account/profile/' + this.user.id
                    ).then(solve => {
                        this.info = solve.data
                    }).catch(solve => {
                        console.log('Error load')
                    }
                );
            },
            validateState(name) {
                const { $dirty, $error } = this.$v.user[name];
                return $dirty ? !$error : null;
            },
            onlyOne(checkbox) {
                let checkboxes = $("input[name='is_main']")
                checkboxes.forEach((item) => {
                    if (item !== checkbox) item.checked = false
                })
            },
            updateProfile() {
                this.loading = true
                let data = $('#form').serialize()
                axios.post('/account/profile/update', data
                    ).then(solve => {
                        this.result={message:'Perfil actualizado correctamente',alert:'alert-success'}
                        this.loading = false
                    })
                    .catch(solve => {
                        this.result={message:'Ha ocurrido un error, por favor intente de nuevo',alert:'alert-danger'}
                        this.loading = false
                    }
                );
            }
        }
    }
</script>
