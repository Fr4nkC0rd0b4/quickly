<template>
    <div class="container-fluid">
        <header-component title="Detalle de solicitud de envío"></header-component>
        <div class="row">
            <div class="col">
                <div class="card" v-if="loadingItem">
                    <scale-loader :size="'50px'"></scale-loader>
                </div>
                <div class="card" v-else>
                    <div class="card-header">
                        <h5>Solicitud: {{ delivery.id }}</h5>
                    </div>
                    <div class="card-body">

                        <!-- Delivery Component -->
                        <delivery-component ref="accept" :delivery="delivery" @loading="loading = $event"></delivery-component>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <button class="btn btn-sm btn-secondary float-right col-sm m-2" @click="$router.back()">Volver</button>
                            <button v-if="!loading" class="btn btn-sm btn-primary float-right col-sm m-2" @click="accept()">
                                Ofertar tarifa
                            </button>
                            <button v-if="loading" class="btn btn-sm btn-primary float-right col-sm m-2">
                                <scale-loader :loading="loading" height="10px"></scale-loader>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DeliveryComponent from "../../components/DeliveryComponent";
    import ScaleLoader from 'vue-spinner/src/ScaleLoader.vue';

    export default {
        components: {
            DeliveryComponent,
            ScaleLoader
        },
        data() {
            return {
                baseURL: '/delivery/',
                delivery: {},
                loading: false,
                loadingItem: false,
            }
        },
        methods: {
            accept() {
                this.$refs.accept.acceptDelivery();
            },
        },
        computed: {
            getDelivery() {
                this.loading = false;
                this.loadingItem = true;

                if(this.$route.name == 'delivery.show') {
                    axios.get(this.baseURL + this.$route.params.id).then(solve => {
                        this.delivery = solve.data;
                        this.loadingItem = false;
                    });
                }
            }
        },
    }
</script>