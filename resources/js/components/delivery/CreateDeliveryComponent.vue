<template>
	<div class="container-fluid">
		<header-component></header-component>

		<div class="row justify-content-center">
			<div class="container">
				<form-wizard id="deliveryForm" title="" subtitle="" color="#727cf5"  @on-complete="onComplete">
				    <tab-content title="Información inicial" >
				    	<label for="type">Eliga tipo de producto</label>
				        <select id="type" class="form-control" name="type" required>
				        	<option value=""></option>
				        	<option value="1">Documentación</option>
				        	<option value="2">Paquetes</option>
				        </select>

				        <label for="destinationCity">Ciudad destino</label>
				        <input id="destinationCity" class="form-control" type="text" name="destination_city" required>

				        <label for="originCity">Ciudad origen</label>
				        <input id="originCity" class="form-control" type="text" name="origin_city" required>

				        <label for="shippingPoint">Punto de entrega</label>
				        <input id="shippingPoint" class="form-control" type="text" name="shipping_point">

				        <label for="pickUpPoint">Punto de recibimiento</label>
				        <input id="pickUpPoint" class="form-control" type="text" name="pick_up_point">
				    </tab-content>
				    <tab-content title="Información adicional">
				        Segundo paso
				    </tab-content>
				    <tab-content title="Verificación">
				        Tercer paso
				    </tab-content>
				</form-wizard>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
    	data(){
            return {
                
            }
        },
        methods: {
        	onComplete: function(){
        		var form = document.querySelector('form');
				var data = new FormData(form);

        		axios.post('delivery/store', data)
        			.then(function() {
        				alert('enviado');
        			})
        			.catch(function() {
        				alert('no enviado');
        			});
        			
    		}
        }
    }
</script>