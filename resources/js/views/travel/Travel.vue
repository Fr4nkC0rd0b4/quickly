<template>
    <div class="container-fluid">
        <header-component title="Travels" :add_link="add_link" :route="route" @item="travels = $event"></header-component>
        
        <div style="text-align: left;" v-if="result.message!=''" :class="result.alert" class="alert alert-dismissible fade show" role="alert">
            {{result.message}}
            <button type="button" @click="result={message:'',alert:''}" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div v-for="travel in travels" class="col-xl-6">
                        <div class="ribbon-box card" role="button" @click="openModal(travel)">
                            <div class="card-body">
                                <div class="ribbon ribbon-primary float-left">
                                    <b-icon-person></b-icon-person>
                                    {{ travel.user?travel.user.name:'' }}
                                </div>
                                <!-- <h5 class="text-primary float-right mt-0">
                                    {{ travel.type ? travel.type : '' }}
                                </h5> -->
                                <div class="ribbon-content">
                                    <p class="mb-0">De {{ travel.origin }} a {{ travel.destination }}.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <infinite-loading @infinite="infiniteHandler" spinner="waveDots">
                    <div slot="no-more">No hay mas datos :)</div>
                    <div slot="no-results">No hay resultados :(</div>
                    <div slot="error" slot-scope="{ trigger }">
                        Error interno, click <a href="javascript:;" @click="trigger">aquí</a> para reintentar o intenta <a href="javascript:;" @click="reload">refrescar</a> para reiniciar sesión.
                    </div>
                </infinite-loading>
            </div>
        </div>
        <b-modal 
            v-model="modalShow"
            centered
            title="Detalle"
            hide-backdrop
            content-class="shadow"
            no-close-on-backdrop 
            no-close-on-esc>
            <div class="modal-body">
                <!-- User -->
                <div class="row">
                    <div class="col">Usuario:</div>
                    <div class="col-sm">
                        <span class="account-user-avatar"> 
                            <img :src="details.user?/storage/+details.user.avatar:''" :alt="details.user?details.user.avatar:''" class="rounded-circle" style="height: 50px;">
                        </span>
                        <b-badge pill variant="success">
                            {{ details.user?details.user.name:'' }}
                        </b-badge>
                    </div>
                </div>
                <!-- Travel -->
                <div class="row">
                    <div class="col">Origen:</div>
                    <div class="col-sm">
                        <b-badge pill variant="info">
                            {{ details.origin }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Destino:</div>
                    <div class="col-sm">
                        <b-badge pill variant="info">
                            {{ details.destination }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Vehículo:</div>
                    <div class="col-sm">
                        <b-badge pill variant="info">
                            {{ details.vehicle ? details.vehicle.manufacturer : '' }} - {{ details.vehicle ? details.vehicle.model : '' }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Placa del vehículo:</div>
                    <div class="col-sm">
                        <b-badge pill variant="info">
                            {{ details.vehicle ? details.vehicle.license_plate : '' }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Fecha de registro:</div>
                    <div class="col-sm">
                        <b-badge pill variant="info">
                            {{ details.created_at }}
                        </b-badge>
                    </div>
                </div>
                <hr>
                <form method="POST" id="form">
                    <div class="form-group">
                        <label class="form__label">Asociar a mi solicitud:</label>
                        <select>
                            <option v-for="delivery in deliveries">{{ delivery.origin }}</option>
                        </select>
                    </div>

                </form>
                </div>
            <!-- <template #modal-footer>
                <b-button variant="secondary" class="float-right col-sm" @click="closeModal">
                    Cancelar
                </b-button>
                <b-button v-if="!loading" variant="primary" class="float-right col-sm" @click="acceptDelivery(details.detail.id)">
                    Aceptar entrega
                </b-button>
                <b-button v-if="loading" variant="primary" class="float-right col-sm">
                    <scale-loader :loading="loading" :height="height"></scale-loader>
                </b-button>
            </template> -->
        </b-modal>
    </div>

</template>

<script>
    import { decimal, minLength } from "vuelidate/lib/validators";

    export default {
        mounted() {
            this.getDeliveries();
        },
        data(){
            return {
                travels: [],
                deliveries: [],
                user: '',
                page: 1,
                loading: null,
                result:{ message:'',alert:'' },
                modalShow: false,
                details: [],
                add_link: '/spa/travel/create',
                route: '/travel/',
                state: null,
                final_offer: '',
                id: '',
                loading: false,
                height: '10px'
            }
        },
        validations: {
            final_offer: { decimal, minLength: minLength(4) }
        },
        methods: {
            //Cargo los datos inicialmente usando scroll infinito
            infiniteHandler($state) {
                this.state = $state;
                axios.get(this.route, {params: {page: this.page,searching: this.searching}}
                    ).then(solve => {
                    if (solve.data.data.length>0) {
                        this.page += 1;
                        this.travels.push(...solve.data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                }).catch(solve => {
                    this.state.error();
                });
            },
            reload() {
                window.location.reload();
            },
            openModal(travel, name) {
                this.details = travel
                this.modalShow = !this.modalShow
            },
            closeModal() {
                this.modalShow = !this.modalShow
                this.loading = false
            },
            /*validateState(value) {
                this.final_offer = value
                this.$v.final_offer.$touch()
            },*/
            getDeliveries() {
                axios.get('/delivery/pendings').then(solve=>{
                    console.log("Cargado")
                    this.deliveries = solve.data.data
                }).catch(solve=>{
                    console.log("No cargado")
                })
            }
        }
    }
</script>
