<template>
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="text-center">
                <img :src="/storage/+url_img_page" height="90" alt="File not found Image">

                <h1 class="text-error">4<i class="fa fa-frown-o"></i>4</h1>
                <h4 class="text-uppercase text-danger mt-3">Página no encontrada</h4>
                <p class="text-muted mt-3">Parece que te has equivocado de rumbo. No te preocupes ... nos pasa a los mejores. Aquí tienes un pequeño consejo que podría ayudarte a retomar el rumbo.</p>

                <router-link to="/home" class="btn btn-info mt-3"><i class="mdi mdi-reply"></i> Volver al inicio</router-link>
            </div> <!-- end /.text-center-->
        </div> <!-- end col-->
    </div>
    <!-- end row -->
</template>
<script>
    let url_img = document.head.querySelector('meta[name="img_page_not_found"]');
    export default {
        data() {
            return {
                url_img_page: url_img.content,
            }
        }
    }
</script>