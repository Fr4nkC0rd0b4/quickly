<template>
  	<div class="container-fluid">
	  	<header-component title="Registrar envío"></header-component>

	    <div class="row justify-content-center">
			<form-wizard title="" subtitle="" color="#727cf5">
			    <tab-content title="Información inicial" :before-change="beforeTabSwitch">
		    		<div class="row">
				      	<b-form-group class="col" id="input-group" label="Ciudad origen:" label-for="origin-city">
				        	<b-form-input
				          		id="origin-city"
				          		name="origin"
				          		v-model="$v.form.origin.$model"
				          		:state="validateState('origin')"
				          		aria-describedby="input-live-feedback"
				        	></b-form-input>

				        	<b-form-invalid-feedback id="input-live-feedback">
				        		Este campo es requerido.
				        	</b-form-invalid-feedback>
				      	</b-form-group>

				      	<b-form-group class="col" id="input-group-1" label="Ciudad destino:" label-for="destination-city">
				        	<b-form-input
				          		id="destination-city"
				          		name="destination_city"
				          		v-model="$v.form.destination.$model"
				          		:state="validateState('destination')"
				          		aria-describedby="input-1-live-feedback"
				        	></b-form-input>

				        	<b-form-invalid-feedback id="input-1-live-feedback">
				        		Este campo es requerido.
				        	</b-form-invalid-feedback>
				      	</b-form-group>
				    </div>

				    <div class="row">
				      	<b-form-group class="col" id="input-group-2" label="Punto de entrega:" label-for="shipping-point">
				        	<b-form-input
				          		id="shipping-point"
				          		name="shipping_point"
				        	></b-form-input>
				      	</b-form-group>

				      	<b-form-group class="col" id="input-group-3" label="Punto de recogida:" label-for="pick-up-pint">
				        	<b-form-input
				          		id="pick-up-pint"
				          		name="pick_up_pint"
				        	></b-form-input>
				      	</b-form-group>
				    </div>

			      	<b-form-group label="Seleccione tipo de producto:">
				      	<b-form-radio-group
				        	id="radio-group-1"
				        	v-model="$v.form.radio.$model"
				        	:options="options"
				        	name="radio-options"
				        	:state="validateState('radio')"
				      	></b-form-radio-group>
				    </b-form-group>
			    </tab-content>
			    <tab-content title="Información adicional" :before-change="beforeTabSwitch">
			        <div class="row">
			        	<b-form-group class="col" id="input-group-4" label="Peso:" label-for="package_size">
			        		<b-form-input id="package_size" name="size"
			        		></b-form-input>
			        	</b-form-group>
			        </div>
			    </tab-content>
			    <tab-content title="Verificación">
			        Acepto los terminos y condiciones.
			    </tab-content>
			</form-wizard>
		</div>
  	</div>

</template>

<script>
	import { validationMixin } from "vuelidate";
	import { required, minLength } from "vuelidate/lib/validators";

	export default {
	  	mixins: [validationMixin],
	  	data() {
	    	return {
	      		form: {
	        		origin: null,
	        		destination: null,
	        		shipping: null,
	        		pick_up: null,
	        		type: null,
	        		size: null
	      		},
	      		options: [
		          	{ text: 'Documentos', value: 'Document' },
		          	{ text: 'Paquetes', value: 'Package' }
		        ]
	    	};
	  	},
	  	validations: {
		    form: {
	      		origin: {
		        	required
	    		},
	    		destination: {
	    			required
	    		},
	    		radio: {
	    			required
	    		},
	    		type: {
	    			required
	    		}
	   		}
	  	},
	  	methods: {
		    validateState(name) {
	      		const { $dirty, $error } = this.$v.form[name];
	      		return $dirty ? !$error : null;
	    	},
		    beforeTabSwitch() {
		    	let sw = false
		      	this.$v.form.$touch();
		      	if (this.$v.form.$anyError) {
		        	sw = false;
		      	}else{
		      		sw = true;
		      	}

		      	return sw;
		    }
		}
	};
</script>