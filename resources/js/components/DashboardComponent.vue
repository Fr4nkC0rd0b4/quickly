<template>
    <div class="container-fluid">
        <header-component title="Dashboard"></header-component>
        
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
                        this.deliveries = solve.data.data;
                        $state.complete();
                    }
                });
            },
        }
    }
</script>
