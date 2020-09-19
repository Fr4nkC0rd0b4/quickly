<template>
  	<div class="container-fluid">
	  	<header-component title="Registrar envío"></header-component>

	  	<div style="text-align: left;" v-if="result.message!=''" :class="result.alert" class="alert alert-dismissible fade show" role="alert">
        {{result.message}}
            <button type="button" @click="result={message:'',alert:''}" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
	    <div class="row">
	    	<div class="col-12">
				<form method="POST" id="form">
					<form-wizard title="" subtitle="" color="#727cf5" @on-complete="submitForm">
					    <tab-content title="Información inicial" :before-change="validateFirstTab">
				    		<div class="row">
					      		<input name="user_id" type="hidden" v-bind:value="user.id">
						      	<b-form-group class="col" id="input-group" label="Ciudad origen:" label-for="origin-city">
						        	<b-form-input
						          		id="origin-city"
						          		name="origin_city"
						          		v-model="$v.firstForm.origin_city.$model"
						          		:state="validateState('firstForm','origin_city')"
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
						          		v-model="$v.firstForm.destination_city.$model"
						          		:state="validateState('firstForm','destination_city')"
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
						        		v-model="$v.firstForm.shipping_point.$model"
						          		:state="validateState('firstForm','shipping_point')"
						          		aria-describedby="input-2-live-feedback"
						        	></b-form-input>

						        	<b-form-invalid-feedback id="input-2-live-feedback">
						        		Este campo es requerido.
						        	</b-form-invalid-feedback>
						      	</b-form-group>

						      	<b-form-group class="col" id="input-group-3" label="Punto de recogida:" label-for="pick-up-pint">
						        	<b-form-input
						          		id="pick-up-pint"
						          		name="pick_up_point"
						          		placeholder="Dirección"
						          		v-model="$v.firstForm.pick_up_point.$model"
						          		:state="validateState('firstForm','pick_up_point')"
						          		aria-describedby="input-3-live-feedback"
						        	></b-form-input>

						        	<b-form-invalid-feedback id="input-3-live-feedback">
						        		Este campo es requerido.
						        	</b-form-invalid-feedback>
						      	</b-form-group>
						    </div>

					      	<b-form-group id="radio-group" label="Seleccione tipo de producto:" label-for="delivery-type">
						      	<b-form-radio-group
						        	id="delivery-type"
						        	name="type"
						        	:options="options"
						        	v-model="$v.firstForm.type.$model"
						        	:state="validateState('firstForm','type')"
						        	aria-describedby="radio-live-feedback"
						      	></b-form-radio-group>

						      	<b-form-invalid-feedback id="radio-live-feedback">
						        	Este campo es requerido.
						        </b-form-invalid-feedback>
						    </b-form-group>
					    </tab-content>
					    <tab-content title="Información adicional" :before-change="validateSecondTab">
					        <div class="row" v-if="firstForm.type == 'Package'">
					        	<b-form-group class="col" id="input-group-5" label="Alto:" label-for="hight-package">
					        		<b-form-input
					        			id="hight-package"
					        			name="hight"
					        			v-model="$v.secondForm.hight.$model"
					        			:state="validateState('secondForm','hight')"
					        			aria-describedby="input-hight-feedback"
					        		></b-form-input>

					        		<b-form-invalid-feedback id="input-hight-feedback">
						        		Este campo es requerido y debe ser númerico, ejemplo: 1 ó 1,2
						        	</b-form-invalid-feedback>
					        	</b-form-group>
					        
					        	<b-form-group class="col" id="input-group-6" label="Ancho:" label-for="width-package">
					        		<b-form-input
					        			id="width-package"
					        			name="width"
					        			v-model="$v.secondForm.width.$model"
					        			:state="validateState('secondForm','width')"
					        			aria-describedby="input-width-feedback"
					        		></b-form-input>

					        		<b-form-invalid-feedback id="input-width-feedback">
						        		Este campo es requerido y debe ser númerico, ejemplo: 1 ó 1,2
						        	</b-form-invalid-feedback>
					        	</b-form-group>

					        	<b-form-group class="col" id="input-group-7" label="Largo:" label-for="long-package">
					        		<b-form-input
					        			id="long-package"
					        			name="long"
					        			v-model="$v.secondForm.long.$model"
					        			:state="validateState('secondForm','long')"
					        			aria-describedby="input-long-feedback"
					        		></b-form-input>

					        		<b-form-invalid-feedback id="input-long-feedback">
						        		Este campo es requerido y debe ser númerico, ejemplo: 1 ó 1,2
						        	</b-form-invalid-feedback>
					        	</b-form-group>
					        </div>

					        <div class="row">
					        	<b-form-group class="col" id="input-group-4" label="Peso:" label-for="package_size">
					        		<b-form-input
					        			id="package-size"
					        			name="size"
					        			type="number"
					        			v-model="$v.secondForm.size.$model"
					        			:state="validateState('secondForm','size')"
					        			aria-describedby="input-size-feedback"
					        		></b-form-input>

					        		<b-form-invalid-feedback id="input-size-feedback">
						        		Este campo es requerido y debe ser númerico, ejemplo: 1 ó 1,2
						        	</b-form-invalid-feedback>
					        	</b-form-group>

					        	<b-form-group class="col" id="input-group-8" label="Valor declarado:" label-for="declared-value">
					        		<b-form-input
					        			id="declared-value"
					        			name="declared_value"
					        			type="number"
					        			v-model="$v.secondForm.declared_value.$model"
					        			:state="validateState('secondForm','declared_value')"
					        			aria-describedby="input-declared_value-feedback"
					        		></b-form-input>

					        		<b-form-invalid-feedback id="input-declared_value-feedback">
						        		Este campo es requerido y debe ser númerico, ejemplo: 1 ó 1,2
						        	</b-form-invalid-feedback>
					        	</b-form-group>
					        </div>
					    </tab-content>
					    <tab-content title="Verificación" :before-change="validateThirdTab">
					    	<div class="row">
					    		<b-form-group class="col" label-form="checkbox-1">
							    	<b-form-checkbox
							      		id="checkbox-1"
							      		value="accepted"
							      		unchecked-value="not_accepted"
							      		v-model="$v.thirdForm.terms.$model"
					        			:state="validateState('thirdForm','terms')"
					        			aria-describedby="input-terms-feedback"
							    	>
						        		Acepto los terminos y condiciones.
							    	</b-form-checkbox>

							    	<b-form-invalid-feedback id="input-terms-feedback">
							        	Acepte los términos y condiciones.
							        </b-form-invalid-feedback>
							    </b-form-group>
						  	</div>
					    </tab-content>
					</form-wizard>
				</form>
			</div>
		</div>
  	</div>

</template>

<script>
	import { validationMixin } from "vuelidate";
	import { required, minLength, decimal } from "vuelidate/lib/validators";

	let user = document.head.querySelector('meta[name="user"]');

	export default {
	  	mixins: [validationMixin],
	  	computed: {
            user(){
                return JSON.parse(user.content);
            }
        },
	  	data() {
	    	return {
	    		result: {message:'',alert:''},
	      		firstForm: {
	        		origin_city: null,
	        		destination_city: null,
	        		shipping_point: null,
	        		pick_up_point: null,
	        		type: null
	      		},
	      		secondForm: {
	        		hight: null,
	        		width: null,
	        		long: null,
	      			size: null,
	        		declared_value: null
	      		},
	      		thirdForm: {
	      			terms: null
	      		},
	      		options: [
		          	{ text: 'Documentos', value: 'Document' },
		          	{ text: 'Paquetes', value: 'Package' }
		        ]
	    	};
	  	},
	  	validations: {
		    firstForm: {
	      		origin_city: { required },
	    		destination_city: { required },
	    		shipping_point: { required },
	    		pick_up_point: { required },
	    		type: { required }
	   		},
	   		secondForm: {
	   			hight: { required, decimal },
   				width: { required, decimal },
	   			long: { required, decimal },
	   			size: { required },
	   			declared_value: { required }
	   		},
	   		thirdForm: {
	   			terms: { required }
	   		}
	  	},
	  	methods: {
	  		resetForm() {
		      	this.firstForm = {
			        origin_city: null,
					destination_city: null,
					shipping_point: null,
					pick_up_point: null,
					type: null
		      	};
            	this.secondForm = {
			        hight: null,
					width: null,
					long: null
		      	};
		      	this.thirdForm = {
			        terms: null
		      	};

		      	this.$nextTick(() => {
			        this.$validator.reset();
		      	});
		    },
		    validateState(formTab, name) {
		    	if (formTab == 'firstForm') {
	      			const { $dirty, $error } = this.$v.firstForm[name];
	      			return $dirty ? !$error : null;
		    	}else if (formTab == 'secondForm') {
		    		const { $dirty, $error } = this.$v.secondForm[name];
		    		return $dirty ? !$error : null;
		    	}else{
		    		const { $dirty, $error } = this.$v.thirdForm[name];
		    		return $dirty ? !$error : null;
		    	}
	    	},
		    validateFirstTab() {
		    	let sw = false;
		    	
	    		this.$v.firstForm.$touch();
		      	if (this.$v.firstForm.$anyError) {
		        	sw = false;
		      	}else{
		      		sw = true;
		      	}

		      	if (this.firstForm.type == 'Document') {
		      		this.secondForm = {
				        hight: 0,
						width: 0,
						long: 0
			      	};
		      	}

		      	return sw;
		    },
		    validateSecondTab() {
		    	let sw = false;

		    	this.$v.secondForm.$touch();
		      	if (this.$v.secondForm.$anyError) {
		        	sw = false;
		      	}else{
		      		sw = true;
		      	}

		      	return sw;
		    },
		    validateThirdTab() {
		    	let sw = false;

		    	this.$v.thirdForm.$touch();
		      	if (this.$v.thirdForm.$anyError) {
		        	sw = false;
		      	}else{
		      		sw = true;
		      	}

		      	return sw;
		    },
		    submitForm() {
		    	let vm = this
                let data = $('#form').serialize()
                axios.post('/delivery/store', data
                    ).then(function(){
                        vm.result={message:'Perfil actualizado correctamente',alert:'alert-success'}
                        //vm.resetForm()
                    })
                    .catch(function(){
                        vm.result={message:'Ha ocurrido un error, por favor intente de nuevo',alert:'alert-danger'}
                    }
                );
		    }
		}
	};
</script>