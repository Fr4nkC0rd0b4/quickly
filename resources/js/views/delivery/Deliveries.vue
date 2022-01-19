<template>
    <div class="container-fluid">
        <header-component title="Envios" :add_link="add_link" :route="baseURL" @item="deliveries = $event"></header-component>
        
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div v-for="delivery in deliveries" :key="delivery.id" class="col-xl-6">
                        <div class="ribbon-box card" role="button" @click="openModal(delivery)">
                            <div class="card-body">
                                <div class="ribbon ribbon-primary float-left">
                                    <i class="fa fa-user"></i>
                                    {{ delivery.user ? delivery.user.name: '' }}
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
        
        <!-- Delivery Detail Component -->
        <modal-delivery-component
            v-if="modalShow" :delivery="details"
            :visibility="modalShow"
            @visibility="modalShow = $event">
        </modal-delivery-component> 
    </div>

</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';
    import ModalDeliveryComponent from "../../components/ModalDeliveryComponent";

    export default {
        components: {
            InfiniteLoading,
            ModalDeliveryComponent
        },
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
        data() {
            return {
                deliveries: [],
                page: 1,
                modalShow: false,
                details: [],
                add_link: 'delivery.create',
                baseURL: '/delivery/',
                state: null
            }
        },
        methods: {

            //Cargo los datos inicialmente usando scroll infinito
            infiniteHandler($state) {
                this.state = $state;

                axios.get(this.baseURL, {params: {page: this.page,searching: this.searching}}
                    ).then(solve => {
                    if (solve.data.data.length > 0) {
                        this.page += 1;
                        this.deliveries.push(...solve.data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                }).catch(() => {
                    this.state.error();
                });
            },
            reload() {
                window.location.reload();
            },
            openModal(delivery) {
                this.details = delivery;
                // this.details.created_at = this.details.created_at.split('T')[0];
                this.modalShow = !this.modalShow;
            }
        }
    }
</script>
