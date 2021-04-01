<template>
	<div class="container-fluid">

	  	<div style="text-align: left;" v-if="result.message!=''" :class="result.alert" class="alert alert-dismissible fade show" role="alert">
        {{result.message}}
            <button type="button" @click="result={message:'',alert:''}" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

	    <div class="row">
	    	<div class="col-12">
				<form method="POST" id="form">
					<form-wizard title="" subtitle="" color="#727cf5">
					    <tab-content title="Datos personales" :before-change="validatePersonalTab">
				    		<div class="row">
						      	<b-form-group class="col-sm" id="input-name" label="Nombre completo:" label-for="name">
						        	<b-form-input
						        		readonly
						          		id="name"
						          		name="name"
						          		v-model="$v.user.name.$model"
						          		:state="validateState('userTab','name')"
						          		aria-describedby="input-name-live-feedback"
						        	></b-form-input>

						        	<b-form-invalid-feedback id="input-name-live-feedback">
						        		Este campo es requerido.
						        	</b-form-invalid-feedback>
						      	</b-form-group>

						      	<b-form-group class="col-sm" id="input-email" label="Correo electrónico:" label-for="email">
						        	<b-form-input
						        		readonly
						          		id="email"
						          		name="email"
						          		v-model="$v.user.email.$model"
						          		:state="validateState('userTab','email')"
						          		aria-describedby="input-email-live-feedback"
						        	></b-form-input>

						        	<b-form-invalid-feedback id="input-email-live-feedback">
						        		Este campo es requerido.
						        	</b-form-invalid-feedback>
						      	</b-form-group>
						    </div>

						    <div class="row">
						      	<b-form-group class="col-sm" id="input-dni" label="Cédula de ciudadanía:" label-for="dni">
						        	<b-form-input
						          		id="dni"
						          		name="dni"
						        		placeholder="Cédula de ciudadanía"
						        		v-model="$v.user.dni.$model"
						          		:state="validateState('userTab','dni')"
						          		aria-describedby="input-dni-live-feedback"
						        	></b-form-input>

						        	<b-form-invalid-feedback id="input-dni-live-feedback">
						        		Este campo es requerido.
						        	</b-form-invalid-feedback>
						      	</b-form-group>
						      	<hr>
						      	<b-form-group class="col-sm" id="input-address" label="Dirección:" label-for="address">
						        	<b-form-input
						          		id="address"
						          		name="address"
						          		placeholder="Dirección de residencia"
						          		v-model="$v.user.address.$model"
						          		:state="validateState('userTab','address')"
						          		aria-describedby="input-3-live-feedback"
						        	></b-form-input>

						        	<b-form-invalid-feedback id="input-address-live-feedback">
						        		Este campo es requerido.
						        	</b-form-invalid-feedback>
						      	</b-form-group>
						    </div>

					      	<!-- <b-form-group id="radio-group" label="Seleccione tipo de producto:" label-for="delivery-type">
						      	<b-form-radio-group
						        	id="delivery-type"
						        	name="type"
						        	:options="options"
						        	v-model="$v.user.type.$model"
						        	:state="validateState('userTab','type')"
						        	aria-describedby="radio-live-feedback"
						      	></b-form-radio-group>

						      	<b-form-invalid-feedback id="radio-live-feedback">
						        	Este campo es requerido.
						        </b-form-invalid-feedback>
						    </b-form-group> -->
					    </tab-content>
					    <tab-content>
					    	<div class="row">
					    		<b-form-group class="col-sm" id="input-name-owner" label="Nombre del Titular:" label-for="name-owner">
						        	<b-form-input
						          		id="name-owner"
						          		name="name_owner"
						          		v-model="$v.payment.name_owner.$model"
						          		:state="validateState('paymentTab','name_owner')"
						          		aria-describedby="input-name-owner-live-feedback"
						        	></b-form-input>

						        	<b-form-invalid-feedback id="input-name-owner-live-feedback">
						        		Este campo es requerido.
						        	</b-form-invalid-feedback>
						      	</b-form-group>

						      	<b-form-group class="col-sm" id="input-last-name-owner" label="Apellido del Titular:" label-for="last-name-owner">
						        	<b-form-input
						          		id="last-name-owner"
						          		name="last_name_owner"
						          		v-model="$v.payment.last_name_owner.$model"
						          		:state="validateState('paymentTab','last_name_owner')"
						          		aria-describedby="input-last-name-owner-live-feedback"
						        	></b-form-input>

						        	<b-form-invalid-feedback id="input-last-name-owner-live-feedback">
						        		Este campo es requerido.
						        	</b-form-invalid-feedback>
						      	</b-form-group>
					    	</div>

					    	<div class="row">
					    		<b-form-group class="col-sm" id="input-card-type" label="Apellido del Titular:" label-for="card-type">
						        	<b-form-input
						          		id="card-type"
						          		name="card_type"
						          		v-model="$v.payment.card_type.$model"
						          		:state="validateState('paymentTab','card_type')"
						          		aria-describedby="input-card-type-live-feedback"
						        	></b-form-input>

						        	<b-form-invalid-feedback id="input-card-type-live-feedback">
						        		Este campo es requerido.
						        	</b-form-invalid-feedback>
						      	</b-form-group>

					    		<b-form-group class="col-sm" id="input-card-number" label="Apellido del Titular:" label-for="card-number">
						        	<b-form-input
						          		id="card-number"
						          		name="card_number"
						          		v-model="$v.payment.card_number.$model"
						          		:state="validateState('paymentTab','card_number')"
						          		aria-describedby="input-card-number-live-feedback"
						        	></b-form-input>

						        	<b-form-invalid-feedback id="input-card-number-live-feedback">
						        		Este campo es requerido.
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
	let auth_user = document.head.querySelector('meta[name="user"]');
	import { required } from "vuelidate/lib/validators";

	export default {
		mounted() {
			console.log("View mounted.");
		},
		data() {
			return {
				user: JSON.parse(auth_user.content),
				payment: {
					name_owner: '',
					last_name_owner: '',
					franquicia: '',
					card_type: '',
					card_number: ''
				},
				result: { message:'',alert:'' }
			}
		},
		validations: {
			user: {
				name: {required},
				email: {required},
				dni: {required},
				address: {required}
			},
			payment: {
				name_owner: {required},
				last_name_owner: {required},
				franquicia: {required},
				card_type: {required},
				card_number: {required}
			}
		},
		methods: {
			validateState(formTab, name) {
		    	if (formTab == 'userTab') {
	      			const { $dirty, $error } = this.$v.user[name];
	      			return $dirty ? !$error : null;
		    	}else if (formTab == 'paymentTab') {
		    		const { $dirty, $error } = this.$v.payment[name];
		    		return $dirty ? !$error : null;
		    	}
	    	},
		    validatePersonalTab() {
		    	let sw = false;
		    	
	    		this.$v.user.$touch();
		      	if (this.$v.user.$anyError) {
		        	sw = false;
		      	}else{
		      		sw = true;
		      	}

		      	return sw;
		    },
		}
	}
</script>