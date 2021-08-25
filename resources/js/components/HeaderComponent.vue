<template>
    
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <div class="form-inline">
                        <!-- Button trigger modal -->
                        <router-link v-if="add_link" class="m-1 btn btn-primary ml-1" :to="add_link">
                            <i class="fa fw fa-plus"></i>
                        </router-link>
                        <div v-if="route" class="input-group">
                            <input type="search" class="form-control" v-model="searching" @change="search" style="width: 180px" placeholder="Buscar...">
                            <div class="input-group-append">
                                <span class="input-group-text bg-primary border-primary text-white" @click="search">
                                    <b-icon-search></b-icon-search>
                                </span>
                            </div>
                        </div>
                        <button @click="$router.back()" class="btn btn-secondary ml-2"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-info ml-1"><i class="fa fa-refresh"></i></button>
                    </div>
                </div>
                <h4 class="page-title">{{ title }}</h4>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        props: {
            title: '',
            add_link: null,
            route: null
        },
        data() {
            return {
                deliveries:[],
                searching: ''
            }
        },
        methods: {
            //Busqueda de parametro específico
            search($state) {
                axios.get(this.route, {params: {searching: this.searching}}).then(solve => {
                    if (solve.data.data.length>0) {
                        this.deliveries = solve.data.data;
                    }else {
                        this.deliveries = solve.data.data;
                        //$state.complete();
                    }
                });
                this.$emit('item', this.deliveries);
            }
        }
    }
</script>