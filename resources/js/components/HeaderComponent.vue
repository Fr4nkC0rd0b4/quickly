<template>
    <div class="row">
        <div class="col">
            <div class="page-title-box">
                <div class="page-title-right">
                    <div class="form-inline">
                        <!-- Button trigger modal -->
                        <router-link class="m-1 btn btn-primary ml-1" to="/vue/delivery/create">+</span></router-link>
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
    
</template>
