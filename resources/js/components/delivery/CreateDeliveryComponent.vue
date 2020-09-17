<template>
  	<div class="container-fluid">
	  	<header-component title="Registrar envío"></header-component>

	    <div class="row">
	    	<div class="col-12">
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
					        		placeholder="Dirección"
					        	></b-form-input>
					      	</b-form-group>

					      	<b-form-group class="col" id="input-group-3" label="Punto de recogida:" label-for="pick-up-pint">
					        	<b-form-input
					          		id="pick-up-pint"
					          		name="pick_up_pint"
					          		placeholder="Dirección"
					        	></b-form-input>
					      	</b-form-group>
					    </div>

				      	<b-form-group id="radio-group" label="Seleccione tipo de producto:" label-for="delivery-type">
					      	<b-form-radio-group
					        	id="delivery-type"
					        	v-model="$v.form.type.$model"
					        	:options="options"
					        	name="type"
					        	:state="validateState('type')"
					        	aria-describedby="radio-live-feedback"
					      	></b-form-radio-group>

					      	<b-form-invalid-feedback id="radio-live-feedback">
					        	Este campo es requerido.
					        </b-form-invalid-feedback>
					    </b-form-group>
				    </tab-content>
				    <tab-content title="Información adicional" :before-change="beforeTabSwitch">
				        <div class="row">
				        	<b-form-group v-if="!sw" class="col" id="input-group-4" label="Peso:" label-for="package_size">
				        		<b-form-input
				        			id="package-size"
				        			name="size"
				        			v-model="$v.form.size.$model"
				        			:state="validateState('size')"
				        			aria-describedby="input-size-feedback"
				        		></b-form-input>

				        		<b-form-invalid-feedback id="input-size-feedback">
					        	Este campo es requerido.
					        </b-form-invalid-feedback>
				        	</b-form-group>

				        	<b-form-group class="col" id="input-group-5" label="Alto:" label-for="hight-package">
				        		<b-form-input id="hight-package" name="hight"
				        		></b-form-input>
				        	</b-form-group>
				        </div>
				        <div class="row">
				        	<b-form-group class="col" id="input-group-6" label="Ancho:" label-for="width-package">
				        		<b-form-input id="width-package" name="width"
				        		></b-form-input>
				        	</b-form-group>

				        	<b-form-group class="col" id="input-group-7" label="Largo:" label-for="long-package">
				        		<b-form-input id="long-package" name="long"
				        		></b-form-input>
				        	</b-form-group>
				        </div>

				        <div class="row">
				        	<b-form-group class="col" id="input-group-8" label="Valor declarado:" label-for="declared-value">
				        		<b-form-input id="declared-value" name="declared_value"
				        		></b-form-input>
				        	</b-form-group>
				        </div>
				    </tab-content>
				    <tab-content title="Verificación">
				    	<div class="row">
					    	<b-form-checkbox
					      		id="checkbox-1"
					      		name="checkbox-1"
					      		value="accepted"
					      		unchecked-value="not_accepted"
					    	>
				        		Acepto los terminos y condiciones.
					    	</b-form-checkbox>
					  	</div>
				    </tab-content>
				</form-wizard>
			</div>
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
	    		sw: false,
	      		form: {
	        		origin: null,
	        		destination: null,
	        		shipping: null,
	        		pick_up: null,
	        		type: null,
	      			size: null,
	        		hight: null,
	        		width: null,
	        		long: null,
	        		declared_value: null
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
	    		type: {
	    			required
	    		},
	    		if (sw = false) {
		    		size: {
		    			required
		    		}
	    		}
	   		}
	  	},
	  	methods: {
		    validateState(name) {
	      		const { $dirty, $error } = this.$v.form[name];
	      		return $dirty ? !$error : null;
	    	},
		    beforeTabSwitch() {
		    	//let sw = false
		      	this.$v.form.$touch();
		      	if (this.$v.form.$anyError) {
		        	this.sw = false;
		      	}else{
		      		this.sw = true;
		      	}

		      	return this.sw;
		    }
		}
	};
</script>