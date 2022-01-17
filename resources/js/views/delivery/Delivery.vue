<template>
    <div class="container-fluid">
        <header-component title="Dashboard" :add_link="add_link" :route="route" @item="deliveries = $event"></header-component>
        
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div v-for="delivery in deliveries" class="col-xl-6">
                        <div class="ribbon-box card" role="button" @click="openModal(delivery)">
                            <div class="card-body">
                                <div class="ribbon ribbon-primary float-left">
                                    <b-icon-person></b-icon-person>
                                    {{ delivery.user?delivery.user.name:'' }}
                                </div>
                                <h5 class="text-primary float-right mt-0">
                                    {{ delivery.type ? delivery.type : '' }}
                                </h5>
                                <div class="ribbon-content">
                                    <p class="mb-0">De {{ delivery.origin }} a {{ delivery.destination }}.</p>
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
            :title="'Solicitdu # ' + details.id"
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
                <!-- Delivery -->
                <div class="row">
                    <div class="col">Origen:</div>
                    <div class="col-sm">
                        <b-badge pill variant="info">
                            {{ details.pick_up_point }} - {{ details.origin }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Destino:</div>
                    <div class="col-sm">
                        <b-badge pill variant="info">
                            {{ details.delivery_point }} - {{ details.destination }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Tipo de envío:</div>
                    <div class="col-sm">
                        <b-badge pill variant="info">
                            {{ details.type }}
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
                <!-- Delivery Details -->
                <div class="row">
                    <div class="col">Oferta inicial:</div>
                    <div class="col-sm">
                        <b-badge pill variant="info">
                            {{ details.detail?details.detail.initial_offer:'' }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Contenido:</div>
                    <div class="col-sm">
                        <b-badge pill variant="info">
                            {{ details.detail?details.detail.content:'' }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Peso:</div>
                    <div class="col-sm">
                        <b-badge pill variant="info">
                            {{ details.detail?details.detail.size:'' }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Alto:</div>
                    <div class="col-sm">
                        <b-badge pill variant="info">
                            {{ details.detail?details.detail.hight:'' }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Largo:</div>
                    <div class="col-sm">
                        <b-badge pill variant="info">
                            {{ details.detail?details.detail.long:'' }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Ancho:</div>
                    <div class="col-sm">
                        <b-badge pill variant="info">
                            {{ details.detail?details.detail.width:'' }}
                        </b-badge>
                    </div>
                </div>
                <hr>
                <form method="POST" id="form">
                    <input type="hidden" name="id" :value="details.detail?details.detail.id:''">
                    <div class="form-group" :class="{ 'text-danger': $v.final_offer.$error }">
                        <label class="form__label">Ofertar precio (Opcional):</label>
                        <input class="form-control" name="final_offer" v-model.trim="final_offer" @input="validateState($event.target.value)"/>
                    </div>
                    <div class="text-danger" v-if="!$v.final_offer.decimal">El campo debe ser númerico.</div>
                    <div class="text-danger" v-if="!$v.final_offer.minLength">El campo debe tener mínimo {{$v.final_offer.$params.minLength.min}} dígitos.</div>
                </form>
            </div>
            <template #modal-footer>
                <b-button variant="secondary" class="float-right col-sm" @click="closeModal">
                    Cancelar
                </b-button>
                <b-button v-if="!loading" variant="primary" class="float-right col-sm" @click="acceptDelivery(details.detail.id)">
                    Aceptar entrega
                </b-button>
                <b-button v-if="loading" variant="primary" class="float-right col-sm">
                    <scale-loader :loading="loading" :height="height"></scale-loader>
                </b-button>
            </template>
        </b-modal>
    </div>

</template>

<script>
    import { decimal, minLength } from "vuelidate/lib/validators";

    export default {
        mounted() {
            toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            if (this.$route.params.status) {
                this.$route.params.status == 'error' ? toastr.error(this.$route.params.message) : toastr.success(this.$route.params.message);
            }
        },
        props: ['status', 'message'],
        data(){
            return {
                deliveries: [],
                user: '',
                page: 1,
                loading: null,
                modalShow: false,
                details: [],
                add_link: 'delivery.create',
                route: '/delivery/',
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
                        this.deliveries.push(...solve.data.data);
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
            openModal(delivery, name) {
                this.details = delivery
                this.modalShow = !this.modalShow
            },
            closeModal() {
                this.modalShow = !this.modalShow
                this.final_offer = ''
                this.loading = false
            },
            validateState(value) {
                this.final_offer = value
                this.$v.final_offer.$touch()
            },
            acceptDelivery(id) {
                this.loading = true
                if (!this.$v.final_offer.$anyError) {
                    axios.put(this.route + '{$delivery}' , {id:id, final_offer:this.final_offer}
                        ).then(solve => {
                            toastr.options =
                            {
                                "closeButton" : true,
                                "progressBar" : true
                            }
                            toastr.success('Solicitud aceptada, click aquí para gestionarla.');
                        }).catch(solve => {
                            toastr.options =
                            {
                                "closeButton" : true,
                                "progressBar" : true
                            }
                            toastr.error('Ha ocurrido un error interno, por favor intente de nuevo.');
                        });
                }
                this.closeModal()
            }
        }
    }
</script>
