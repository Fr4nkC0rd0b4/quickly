<template>
  	<div class="container-fluid">
	  	<header-component title="Registrar envío"></header-component>
        
	    <div class="row">
	    	<div class="col-12">
				<form id="form" v-on:submit.prevent>
					<form-wizard ref="wizard" title="" subtitle="" color="#727cf5" @on-complete="submitForm">
					    <tab-content title="Información inicial" :before-change="validate">
				    		<div class="row mt-2">
				    			<!-- select ciudad de origen -->
						      	<div class="col-sm">
					      			<label :class="{ 'text-danger': $v.firstTab.origin.$error }">Ciudad origen:</label>
						      		<v-select name="origin" label="name" :options="cities" v-model="firstTab.origin" :reduce="cities => `${cities.name} - ${cities.departament.name}`">
						      			<template slot="option" slot-scope="option">
									       	{{ option.name }} - {{option.departament?option.departament.name:''}}
									   	</template>
						      		</v-select>
						      		<input type="hidden" name="origin" v-model.trim="firstTab.origin">
						      		<div class="text-danger" v-if="$v.firstTab.origin.$error">Este campo es obligatorio</div>
						      	</div>
						      	<!-- select ciudad destino -->
						      	<div class="col-sm">
						      		<label :class="{ 'text-danger': $v.firstTab.destination.$error }">Ciudad destino:</label>
						      		<v-select name="destination" label="name" :options="cities" v-model="firstTab.destination" :reduce="cities => `${cities.name} - ${cities.departament.name}`">
						      			<template slot="option" slot-scope="option">
									       	{{ option.name }} - {{option.departament?option.departament.name:''}}
									   	</template>
						      		</v-select>
						      		<input type="hidden" name="destination" v-model.trim="firstTab.destination">
						      		<div class="text-danger" v-if="$v.firstTab.destination.$error">Este campo es obligatorio</div>
						      	</div>
						    </div>

						    <div class="row mt-2">
						    	<!-- input punto de recogida -->
						    	<div class="col-sm">
						    		<label :class="{ 'text-danger': $v.firstTab.pick_up_point.$error }">Punto de recogida:</label>

						      		<input type="text" class="form-control" name="pick_up_point" v-model.trim="firstTab.pick_up_point">

						      		<div class="text-danger" v-if="$v.firstTab.pick_up_point.$error">Este campo es obligatorio</div>
						    	</div>
						    	<!-- input punto de entrega -->
						      	<div class="col-sm">
						    		<label :class="{ 'text-danger': $v.firstTab.delivery_point.$error }">Punto de entrega:</label>

						      		<input type="text" class="form-control" name="delivery_point" v-model.trim="firstTab.delivery_point">

						      		<div class="text-danger" v-if="$v.firstTab.delivery_point.$error">Este campo es obligatorio</div>
						    	</div>
						    </div>
						    <div class="col-sm mt-2">
						    	<div class="row">
						    		<label for="delivery-type" :class="{ 'text-danger': $v.firstTab.type.$error }">Seleccione tipo de producto:</label>
						    	</div>
						    	<div class="row">
							    	<div class="mt-2">
									    <div class="form-check form-check-inline">
									        <input type="radio" id="radio-package" name="type" class="form-check-input" value="Package" v-model.trim="firstTab.type">
									        <label class="form-check-label" for="radio-package">Paquete</label>
									    </div>
									    <div class="form-check form-check-inline">
									        <input type="radio" id="radio-documents" name="type" class="form-check-input" value="Document" v-model.trim="firstTab.type">
									        <label class="form-check-label" for="radio-documents">Documentos</label>
									    </div>
									</div>
						    	</div>
						    	<div class="text-danger" v-if="$v.firstTab.type.$error">Este campo es obligatorio</div>
						    </div>
					    </tab-content>

					    <tab-content title="Información adicional" :before-change="validate">
					        <div class="row mt-2" v-if="firstTab.type == 'Package'">
					        	<div class="col-sm">
					        		<label for="hight-package">Alto (centímetros):</label>
					        		<input id="hight-package" type="number" name="hight" class="form-control">
					        	</div>
					        	
					        	<div class="col-sm">
					        		<label for="width-package">Ancho (centímetros):</label>
					        		<input id="width-package" type="number" name="width" class="form-control">
					        	</div>

					        	<div class="col-sm">
					        		<label for="long-package">Largo (centímetros):</label>
					        		<input id="long-package" type="number" name="long" class="form-control">
					        	</div>
					        </div>

					        <div class="row mt-2" v-if="firstTab.type == 'Package'">
					        	<div class="col-sm">
						      		<label :class="{ 'text-danger': $v.secondTab.content.$error }">Contenido:</label>

						      		<input type="text" class="form-control" name="content" v-model.trim="secondTab.content">

						      		<div class="text-danger" v-if="$v.secondTab.content.$error">Este campo es obligatorio</div>
						      	</div>

					        	<div class="col-sm">
					        		<label for="size-package">Peso (libras):</label>
					        		<input id="size-package" type="number" name="size" class="form-control">
					        	</div>
					        </div>
					        <div class="row mt-2">
					        	<div class="col-sm">
						      		<label :class="{ 'text-danger': $v.secondTab.initial_offer.$error }">Ofertar precio:</label>

						      		<input type="number" class="form-control" name="initial_offer" v-model.trim="secondTab.initial_offer">

						      		<div class="text-danger" v-if="$v.secondTab.initial_offer.$error">Este campo es obligatorio</div>
						      	</div>
					        </div>
					    </tab-content>
					    
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
	import { required, decimal } from "vuelidate/lib/validators";

	import {FormWizard, TabContent} from 'vue-form-wizard'
	import 'vue-form-wizard/dist/vue-form-wizard.min.css'

	export default {
	  	mixins: [validationMixin],
	  	components: {
  			FormWizard,
  			TabContent
		},
	  	mounted() {
	  		this.getCities();
	  	},
	  	data() {
	    	return {
	    		cities: [],
	    		loading: false,
                height: '10px',
	      		firstTab: {
	        		origin: null,
	        		destination: null,
	        		delivery_point: null,
	        		pick_up_point: null,
	        		type: null
	      		},
	      		secondTab: {
	        		hight: null,
	        		width: null,
	        		long: null,
	        		content: null,
	      			size: null,
	        		initial_offer: null
	      		},
	      		/*thirdForm: {
	      			terms: null
	      		},*/
	    	};
	  	},
	  	validations() {
	  		if (this.firstTab.type == 'Document') {
		  		return {
				    firstTab: {
			      		origin: { required },
			    		destination: { required },
			    		delivery_point: { required },
			    		pick_up_point: { required },
			    		type: { required }
			   		},
			   		secondTab: {
			   			initial_offer: { required, decimal }
			   		},
			   		/*thirdForm: {
			   			terms: { required }
			   		}*/
		  		}
	  		}else{
	  			return {
				    firstTab: {
			      		origin: { required },
			    		destination: { required },
			    		delivery_point: { required },
			    		pick_up_point: { required },
			    		type: { required }
			   		},
			   		secondTab: {
			   			content: { required },
			   			initial_offer: { required, decimal }
			   		},
			   		/*thirdForm: {
			   			terms: { required }
			   		}*/
		  		}
	  		}
	  	},
	  	methods: {
	  		getCities() {
	  			axios.get('/helpers/cities').then(solve => {
	  				this.cities = solve.data
	  			})
	  		},
	  		resetForm() {
		      	this.firstTab = {
			        origin: null,
					destination: null,
					delivery_point: null,
					pick_up_point: null,
					type: null
		      	};
            	this.secondTab = {
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
		    validate(tab) {
		    	let sw = false;

		    	
		    	switch(this.$refs.wizard.activeTabIndex) {
		    		case 0:
		    			this.$v.firstTab.$touch();
		    			sw = this.$v.firstTab.$invalid ? false : true
		    		break;
		    		case 1:
		    			this.$v.secondTab.$touch();
		    			sw = this.$v.secondTab.$invalid ? false : true
		    		break;
		    	}
		    	
		      	/*if (this.firstTab.type == 'Document') {
			      	this.secondTab.hight = 0;
			      	this.secondTab.width = 0;
			      	this.secondTab.long = 0;
			      	this.secondTab.content = 0;
			      	this.secondTab.size = 0;
		      	}*/

		      	return sw;
		    },
		    submitForm() {
		    	this.$v.$touch();
		    	this.loading = true
                let data = $('#form').serialize()
                axios.post('/delivery', data
                    ).then(() => {
                        this.$router.push({
                        	name:'deliveries',
                        	params: {status: 'success', message: 'Solicitud registrada con éxtio'}
                        })
                    })
                    .catch(() => {
                    	toastr.options =
				            {
				                "closeButton" : true,
				                "progressBar" : true
				            }
				        toastr.error('Ha ocurrido un error interno, por favor intente de nuevo.');
                    	this.loading = false;
                    }
                );
		    }
		}
	};
</script>