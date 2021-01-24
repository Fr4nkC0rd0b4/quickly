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
						      	<b-form-group class="col-sm" id="input-group" label="Ciudad origen:" label-for="origin-city">
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

						      	<b-form-group class="col-sm" id="input-group-1" label="Ciudad destino:" label-for="destination-city">
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
						      	<b-form-group class="col-sm" id="input-group-2" label="Punto de entrega:" label-for="place_of_delivery">
						        	<b-form-input
						          		id="place_of_delivery"
						          		name="place_of_delivery"
						        		placeholder="Dirección"
						        		v-model="$v.firstForm.place_of_delivery.$model"
						          		:state="validateState('firstForm','place_of_delivery')"
						          		aria-describedby="input-2-live-feedback"
						        	></b-form-input>

						        	<b-form-invalid-feedback id="input-2-live-feedback">
						        		Este campo es requerido.
						        	</b-form-invalid-feedback>
						      	</b-form-group>

						      	<b-form-group class="col-sm" id="input-group-3" label="Punto de recogida:" label-for="pick-up-place">
						        	<b-form-input
						          		id="pick-up-place"
						          		name="pick_up_place"
						          		placeholder="Dirección"
						          		v-model="$v.firstForm.pick_up_place.$model"
						          		:state="validateState('firstForm','pick_up_place')"
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
					        	<b-form-group class="col-sm" id="input-group-5" label="Alto:" label-for="hight-package">
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
					        
					        	<b-form-group class="col-sm" id="input-group-6" label="Ancho:" label-for="width-package">
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

					        	<b-form-group class="col-sm" id="input-group-7" label="Largo:" label-for="long-package">
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
					        	<b-form-group class="col-sm" id="input-group-4" label="Peso:" label-for="size-package">
					        		<b-form-input
					        			id="size-package"
					        			name="size"
					        			v-model="$v.secondForm.size.$model"
					        			:state="validateState('secondForm','size')"
					        			aria-describedby="input-size-feedback"
					        		></b-form-input>

					        		<b-form-invalid-feedback id="input-size-feedback">
						        		Este campo es requerido y debe ser númerico, ejemplo: 1 ó 1,2
						        	</b-form-invalid-feedback>
					        	</b-form-group>

					        	<b-form-group class="col-sm" id="input-group-8" label="Valor declarado:" label-for="initial-offer">
					        		<b-form-input
					        			id="initial-offer"
					        			name="initial_offer"
					        			v-model="$v.secondForm.initial_offer.$model"
					        			:state="validateState('secondForm','initial_offer')"
					        			aria-describedby="input-initial_offer-feedback"
					        		></b-form-input>

					        		<b-form-invalid-feedback id="input-initial_offer-feedback">
						        		Este campo es requerido y debe ser númerico, ejemplo: 1 ó 1,2
						        	</b-form-invalid-feedback>
					        	</b-form-group>
					        </div>
					    </tab-content>
					    <!-- <tab-content title="Verificación" :before-change="validateThirdTab">
					    	<div class="row">
					    		<b-form-group class="col-sm" label-form="checkbox-1">
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
					    </tab-content> -->
					    <button v-if="loading" slot="finish" class="btn btn-primary">
					    	<scale-loader :loading="loading" :height="height"></scale-loader>
					    </button>
					</form-wizard>
				</form>
			</div>
		</div>
  	</div>

</template>

<script>
	import { validationMixin } from "vuelidate";
	import { required, minLength, decimal } from "vuelidate/lib/validators";

	export default {
	  	mixins: [validationMixin],
	  	data() {
	    	return {
	    		result: { message:'',alert:'' },
	    		loading: false,
                height: '10px',
	      		firstForm: {
	        		origin_city: null,
	        		destination_city: null,
	        		place_of_delivery: null,
	        		pick_up_place: null,
	        		type: null
	      		},
	      		secondForm: {
	        		hight: null,
	        		width: null,
	        		long: null,
	      			size: null,
	        		initial_offer: null
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
	    		place_of_delivery: { required },
	    		pick_up_place: { required },
	    		type: { required }
	   		},
	   		secondForm: {
	   			hight: { required, decimal },
   				width: { required, decimal },
	   			long: { required, decimal },
	   			size: { required, decimal },
	   			initial_offer: { required, decimal }
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
					place_of_delivery: null,
					pick_up_place: null,
					type: null
		      	};
            	this.secondForm = {
			        hight: null,
					width: null,
					long: null,
					size: null,
					initial_offer: null
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
			      	this.secondForm.hight = 0;
			      	this.secondForm.width = 0;
			      	this.secondForm.long = 0;
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
		    	this.loading = true
		    	let vm = this
                let data = $('#form').serialize()
                axios.post('/delivery', data
                    ).then(function(){
                        vm.$router.push('/home');
                    })
                    .catch(function(){
                    	vm.loading = false
                        vm.result = { message:'Ha ocurrido un error, por favor intente de nuevo',alert:'alert-danger' }
                    }
                );
		    }
		}
	};
</script>