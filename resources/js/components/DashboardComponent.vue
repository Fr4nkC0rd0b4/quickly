<template>
    <div class="container-fluid">
        <header-component title="Dashboard" :add_link="add_link" :search_link="search_link" @item="deliveries = $event"></header-component>
        
        <div style="text-align: left;" v-if="result.message!=''" :class="result.alert" class="alert alert-dismissible fade show" role="alert">
            {{result.message}}
            <button type="button" @click="result={message:'',alert:''}" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div v-for="delivery in deliveries" class="col-xl-6">
                        <div class="ribbon-box card" role="button" @click="openModal(delivery, delivery.user.name)">
                            <div class="card-body">
                                <div class="ribbon ribbon-primary float-left">
                                    <b-icon-person></b-icon-person>
                                    {{ delivery.user.name }}
                                </div>
                                <h5 class="text-primary float-right mt-0">{{ delivery.type }}</h5>
                                <div class="ribbon-content">
                                    <p class="mb-0">De {{ delivery.origin_city }} a {{ delivery.destination_city }}.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <infinite-loading @infinite="infiniteHandler" spinner="waveDots"></infinite-loading>
            </div>
        </div>
        <b-modal v-model="modalShow" centered title="Detalle">
            <div class="modal-body">
                <div class="row">
                    <div class="col">Usuario:</div>
                    <div class="col">
                        <b-badge pill variant="success">
                            {{ user }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Origen:</div>
                    <div class="col">
                        <b-badge pill variant="info">
                            {{ details.shipping_point }} - {{ details.origin_city }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Destino:</div>
                    <div class="col">
                        <b-badge pill variant="info">
                            {{ details.pick_up_point }} - {{ details.destination_city }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Tipo de envío:</div>
                    <div class="col">
                        <b-badge pill variant="info">
                            {{ details.type }}
                        </b-badge>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Fecha de registro:</div>
                    <div class="col">
                        <b-badge pill variant="info">
                            {{ details.created_at }}
                        </b-badge>
                    </div>
                </div>
            </div>
        </b-modal>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                deliveries: [],
                user: '',
                page: 1,
                loading: null,
                result:{ message:'',alert:'' },
                modalShow: false,
                details: [],
                add_link: '/vue/delivery/create',
                search_link: '/delivery/index'
            }
        },
        methods: {
            //Cargo los datos inicialmente usando scroll infinito
            infiniteHandler($state) {
                axios.get(this.search_link, {params: {page: this.page,searching: this.searching}}).then(solve => {
                    if (solve.data.data.length>0) {
                        this.page += 1;
                        this.deliveries.push(...solve.data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                });
            },
            openModal(delivery) {
                this.details = delivery
                this.modalShow = !this.modalShow
            }
        }
    }
</script>
