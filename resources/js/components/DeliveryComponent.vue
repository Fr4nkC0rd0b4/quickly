<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <div class="form-inline">
                            <!-- Button trigger modal -->
                            <button class="m-1 btn btn-primary ml-1" data-toggle="modal" data-target="#createDeliverModal">+</span></button>
                            <div class="input-group">
                                <input type="search" class="form-control" v-model="searching" @change="search" style="width: 180px" placeholder="Buscar...">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-primary border-primary text-white" @click="searching">
                                        <span data-feather="search"></span>
                                    </span>
                                </div>
                            </div>
                            <button class="btn btn-primary ml-2"><span data-feather="list"></span></button>
                            <button class="btn btn-primary ml-1"><span data-feather="loader"></span></button>
                        </div>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row justify-content-center">
            <div class="container">
                <div style="text-align: left;" v-if="result.message!=''" :class="result.alert" class="alert alert-dismissible fade show" role="alert">
                    {{result.message}}
                    <button type="button" @click="result={message:'',alert:''}" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row justify-content-center">
                    <div v-for="delivery in deliveries" class="col-xl-6">
                        <div class="ribbon-box card">
                            <div class="card-body">
                                <div class="ribbon ribbon-primary float-left">
                                    <i class="mdi mdi-access-point mr-1"></i> {{ delivery.id }}
                                </div>
                                <h5 class="text-primary float-right mt-0">Primary Header</h5>
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

        <!-- Modal -->
        <div class="modal fade" id="createDeliverModal" tabindex="-1" role="dialog" aria-labelledby="createDeliverModallLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createDeliverModalLabel">Nuevo Envio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-group">
                            <input type="select" name="type" class="form-control">
                            <input type="text" name="destination_city" class="form-control">
                            <input type="text" name="origin_city" class="form-control">
                            <input type="text" name="shipping_point" class="form-control">
                            <input type="text" name="pick_up_point" class="form-control">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
                deliveries:[],
                page: 1,
                searching: '',
                height:'10px',
                loading: null,
                result:{message:'',alert:''}
            }
        },
        methods: {
            //Cargo los datos inicialmente usando scroll infinito
            infiniteHandler($state) {
                axios.get('/delivery/index', {params: {page: this.page,searching: this.searching}}).then(solve => {
                    if (solve.data.data.length>0) {
                        this.page += 1;
                        this.deliveries.push(...solve.data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                });
            },
            //Busqueda de parametro específico
            search($state) {
                this.page = 1
                axios.get('/delivery/index', {params: {page: this.page,searching: this.searching}}).then(solve => {
                    if (solve.data.data.length>0) {
                        this.page += 1;
                        this.deliveries = solve.data.data;
                    }else {
                        $state.complete();
                    }
                });
            },
        }
    }
</script>
