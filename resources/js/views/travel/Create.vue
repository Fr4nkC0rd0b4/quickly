<template>
	<div class="container-fluid">
		<header-component title="Registrar viaje" :add_link="add_link" :route="route" @item="travels = $event"></header-component>

		<div style="text-align: left;" v-if="result.message!=''" :class="result.alert" class="alert alert-dismissible fade show" role="alert">
        {{result.message}}
            <button type="button" @click="result={message:'',alert:''}" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
		<div class="row">
	    	<div class="col-6">
				<form id="form" v-on:submit.prevent>
					<input type="hidden" name="user_id" :value="user.id">
				    <div class="mb-3">
				        <label class="form-label" :class="{ 'text-danger': $v.origin.$error }">Origen:</label>
				    	<v-select id="select-origin" name="origin" label="name" :options="cities" v-model="origin" :reduce="cities => `${cities.name} - ${cities.departament.name}`">
			      			<template slot="option" slot-scope="option">
						       	{{ option.name }} - {{option.departament?option.departament.name:''}}
						   	</template>
			      		</v-select>
			      		<input type="hidden" name="origin" v-model.trim="origin">
			      		<div class="text-danger" v-if="$v.origin.$error">Este campo es obligatorio</div>
				    </div>
				    <div class="mb-3">
				        <label class="form-label" :class="{ 'text-danger': $v.destination.$error }">Destino</label>
				        <v-select id="select-destination" name="destination" label="name" :options="cities" v-model="destination" :reduce="cities => `${cities.name} - ${cities.departament.name}`">
			      			<template slot="option" slot-scope="option">
						       	{{ option.name }} - {{option.departament?option.departament.name:''}}
						   	</template>
			      		</v-select>
			      		<input type="hidden" name="destination" :value="destination">
			      		<div class="text-danger" v-if="$v.destination.$error">Este campo es obligatorio</div>
				    </div>
				    <div class="mb-3">
				        <label class="form-label" :class="{ 'text-danger': $v.vehicle.$error }">Vehículo</label>
				        <v-select id="select-vehicle" label="manufacturer" :options="vehicles" :reduce="vehicles => vehicles.id" v-model="vehicle">
				        	<template slot="option" slot-scope="option">
						       	{{ option.manufacturer }} - {{ option.license_plate }}
						   	</template>
				        </v-select>
			      		<input type="hidden" name="vehicle_id" :value="vehicle">
			      		<div class="text-danger" v-if="$v.vehicle.$error">Este campo es obligatorio</div>
				    </div>
				    <button v-if="loading" role="button" class="btn btn-primary">
					    <scale-loader :loading="loading" :height="height"></scale-loader>
					</button>
				    <button v-else type="button" role="button" @click="submitForm" class="btn btn-primary">Registrar</button>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	//Components
	import {FormWizard, TabContent} from 'vue-form-wizard'
	import { validationMixin } from "vuelidate";
	import { required } from "vuelidate/lib/validators";

	//CSS of components
	import 'vue-form-wizard/dist/vue-form-wizard.min.css'

	let auth_user = document.head.querySelector('meta[name="user"]');

	export default {
		mixins: [validationMixin],
		//Name of components
		components: {
  			FormWizard,
  			TabContent
		},
		mounted() {
			this.getCities();
			this.getVehicles();
		},
		data() {
			return {
				user: JSON.parse(auth_user.content),
				add_link: '/spa/travel/create',
                route: '/travel/',
                result: { message:'',alert:'' },
                cities: [],
                vehicles: [],
                origin: '',
                destination: '',
                vehicle: '',
                loading: false,
                height: '10px'
			}
		},
		validations: {
			origin: { required },
			destination: { required },
			vehicle: { required }
		},
		methods: {
			getCities() {
	  			axios.get('/helpers/cities').then(solve=>{
	  				this.cities = solve.data
	  			})
	  		},
	  		getVehicles() {
	  			axios.get('/helpers/vehicles/'+this.user.id).then(solve=>{
	  				this.vehicles = solve.data
	  			})
	  		},
	  		submitForm() {
	  			this.loading = true
	  			if (this.validate()) {
	                let data = $('#form').serialize()
		  			axios.post(this.route, data).then(solve=>{
		  				this.$router.push('/spa/travel').catch(()=>{});
		  			}).catch(solve=>{
		  				this.result = { message:'Ha ocurrido un error, por favor intente de nuevo',alert:'alert-danger' }
		  				this.loading = false
		  			})
	  			}else{
	  				this.loading = false
	  			}
	  		},
	  		validate() {
	  			this.$v.$touch();

	  			return this.$v.$invalid ? false : true
	  		}
		}
	}
</script>