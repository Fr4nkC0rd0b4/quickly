<template>
    
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <div class="form-inline">
                        <!-- Button trigger modal -->
                        <router-link v-if="add_link" class="m-1 btn btn-primary btn-sm ml-1" :to="{ name: add_link }">
                            <i class="fa fw fa-plus"></i>
                        </router-link>
                        <div v-if="route" class="input-group">
                            <input type="search" class="form-control form-control-sm" v-model="searching" style="width: 180px" placeholder="Buscar...">
                            <div class="input-group-append">
                                <span v-if="searching != ''" class="input-group-text bg-primary border-primary text-white cursor-pointer" @click="search">
                                    <i class="fa fa-search"></i>
                                </span>
                                <span v-else class="input-group-text bg-secondary border-secondary text-white cursor-disabled">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                        <button @click="$router.back()" class="btn btn-secondary btn-sm ml-2"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-info btn-sm ml-1" @click="reload()"><i class="fa fa-refresh"></i></button>
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
                items:[],
                searching: ''
            }
        },
        methods: {

            //Busqueda de parametro específico
            search($state) {
                axios.get(this.route, {params: {searching: this.searching}}).then(solve => {
                    if (solve.data.data.length > 0) {
                        this.items = solve.data.data;
                    }else {
                        this.items = solve.data.data;
                        $state.complete();
                    }
                });
                this.searching = '';
                this.$emit('item', this.items);
            },
            reload() {

            }
        }
    }
</script>

<style>
    .cursor-pointer {
        cursor: pointer;
    }

    .cursor-disabled {
        cursor: not-allowed;
    }

    /* @media (max-width: 767.98px) {
        .page-title-box .page-title {
            display: block;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            line-height: 70px
        }
        .page-title-box .page-title-right {
            display: none
        }
    } */
</style>