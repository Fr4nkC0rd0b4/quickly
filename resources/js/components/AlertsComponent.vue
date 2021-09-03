<template>
	<!-- <div v-if="showAlert" class="alert alert-secondary alert-dismissible bg-secondary text-white border-0 fade show" role="alert">
    	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    	<strong>Solicitud {{ delivery_id }} aceptada por {{ delivery_man }}</strong>
	</div> -->
</template>

<script>
	export default {
  components: {
    alert,
  },

  props: ['user_id'],

  data(){
    return{
      showAlert: false,
      delivery_id: '',
      delivery_man: ''
    }
  },

  mounted() {
    // window.Echo.channel('pizza-tracker.' + this.order_id)
    window.Echo.channel('delivery-status')
    .listen('NotificationsPushEvent', (delivery) =>
    {
      if (this.user_id == delivery.user_id) {
      	toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
            toastr.success(delivery.id);
        this.showAlert = true
        this.delivery_id = delivery.id
        this.devliver_man = delivery.delivery_man
      }
    });
  },
};
</script>