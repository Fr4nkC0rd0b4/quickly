<template>
	<div class="container-fluid">
		<header-component></header-component>

		<div class="row justify-content-center">
			<div class="container">
				<form-wizard id="deliveryForm" title="" subtitle="" color="#727cf5" @on-complete="onComplete">
				    <tab-content title="Información inicial">
				    	<div>
  <div class="form-group" :class="{ 'form-group--error': $v.name.$error }">
    <label class="form__label">Name</label>
    <input class="form__input" v-model.trim="name" @input="setName($event.target.value)"/>
  </div>
  <div class="error" v-if="!$v.name.required">Field is required</div>
  <div class="error" v-if="!$v.name.minLength">Name must have at least {{$v.name.$params.minLength.min}} letters.</div>
  <div class="form-group" :class="{ 'form-group--error': $v.age.$error }">
    <label class="form__label">Age</label>
    <input class="form__input" :value="age" @change="setAge($event.target.value)"/>
  </div>
  <div class="error" v-if="!$v.age.between">Must be between {{$v.age.$params.between.min}} and {{$v.age.$params.between.max}}</div><span tabindex="0">Blur to see changes</span>
</div>
				    	<!-- <label for="type">Eliga tipo de producto</label>
				        <select id="type" class="form-control" name="type" required>
				        	<option value=""></option>
				        	<option value="1">Documentación</option>
				        	<option value="2">Paquetes</option>
				        </select>

				        <label for="destinationCity">Ciudad destino</label>
				        <input id="destinationCity" v-model="city" class="form-control" type="text" name="destination_city" required>

				        <label for="originCity">Ciudad origen</label>
				        <input id="originCity" class="form-control" type="text" name="origin_city" required>

				        <label for="shippingPoint">Punto de entrega</label>
				        <input id="shippingPoint" class="form-control" type="text" name="shipping_point">

				        <label for="pickUpPoint">Punto de recibimiento</label>
				        <input id="pickUpPoint" class="form-control" type="text" name="pick_up_point"> -->
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
	import { required, minLength, between } from 'vuelidate/lib/validators'

export default {
  data() {
    return {
      name: '',
      age: 0
    }
  },
  validations: {
    name: {
      required,
      minLength: minLength(4)
    },
    age: {
      between: between(20, 30)
    }
  },

  methods: {
    setName(value) {
      this.name = value
      this.$v.name.$touch()
    },
    setAge(value) {
      this.age = value
      this.$v.age.$touch()
    }
  }
}
</script>