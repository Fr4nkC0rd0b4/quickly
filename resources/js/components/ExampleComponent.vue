<template>
    <div class="container">
        <div style="text-align: left;" v-if="result.message!=''" :class="result.alert" class="alert alert-dismissible fade show" role="alert">
            {{result.message}}
            <button type="button" @click="result={message:'',alert:''}" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8" style="max-width: 1000px;">
                <div style="overflow: scroll; max-height: 450px;">
                    <div v-for="delivery in deliveries" class="card">
                        <div class="card-header">Example Component</div>

                        <div class="card-body">
                            I'm an example component. Made by Frank Córdoba
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
                busco: '',
                height:'10px',
                loading: null,
                result:{message:'',alert:''}
            }
        },
        methods: {
            //Cargo los datos inicialmente usando scroll infinito
            infiniteHandler($state) {
                axios.get('/delivery/index', {params: {page: this.page,busco: this.busco}}).then(solve => {
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
                axios.get('/delivery/index', {params: {page: this.page,busco: this.busco}}).then(solve => {
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
