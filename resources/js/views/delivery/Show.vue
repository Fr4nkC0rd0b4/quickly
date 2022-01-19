<template>
    <div class="container-fluid">
        <header-component title="Detalle de solicitud de envío"></header-component>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <!-- Delivery Component -->
                        <delivery-component ref="foo" :delivery="delivery" @loading="loading = $event"></delivery-component>
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

    export default {
        components: {
            DeliveryComponent
        },
        mounted() {
            this.id = this.$route.params.id;
            this.getDelivery();
        },
        data() {
            return {
                id: null,
                baseURL: '/delivery/',
                delivery: {},
                loading: false
            }
        },
        methods: {
            getDelivery() {
                axios.get(this.baseURL + this.id).then(solve => {
                    this.delivery = solve.data;
                });
            },
            accept() {
                this.$refs.foo.acceptDelivery();
            },
        }
    }
</script>