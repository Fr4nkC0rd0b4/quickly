<template>
    <b-modal 
        v-model="visibility"
        centered
        size="lg"
        hide-backdrop
        content-class="shadow"
        no-close-on-backdrop 
        no-close-on-esc>
        <template #modal-header>
            <h5>Solicitud: {{ delivery.id }}</h5>
            <!-- Emulate built in modal header close button action -->
            <b-button size="sm" variant="outline-secondary" @click="closeModal()">
                <i class="fa fa-times"></i>
            </b-button>
        </template>
        <div class="modal-body">

            <!-- DeliveryComponent -->
            <delivery-component ref="accept" :delivery="delivery" @loading="loading = $event" @hideModal="closeModal()"></delivery-component>
        </div>
        <template #modal-footer>
            <b-button variant="secondary" class="float-right col-sm" @click="closeModal()">
                Cerrar
            </b-button>
            <b-button v-if="!loading" variant="primary" class="float-right col-sm" @click="accept()">
                Ofertar tarifa
            </b-button>
            <b-button v-if="loading" variant="primary" class="float-right col-sm">
                <scale-loader :loading="loading" height="10px"></scale-loader>
            </b-button>
        </template>
    </b-modal>
</template>

<script>
    import DeliveryComponent from './DeliveryComponent.vue';
    import ScaleLoader from 'vue-spinner/src/ScaleLoader.vue';

    export default {
        components: { DeliveryComponent, ScaleLoader },

        props: {
            delivery: {},
            visibility: false,
        },
        data() {
            return {
                loading: false,
            }
        },
        methods: {
            accept() {
                this.$refs.accept.acceptDelivery();
            },
            closeModal() {
                this.$emit('visibility', false);
            }
        }
    }
</script>