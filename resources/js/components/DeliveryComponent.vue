<template>
    <div class="col">
        <!-- User -->
        <div class="row">
            <div class="col">Solicitante:</div>
            <div class="col-sm">
                <span class="account-user-avatar"> 
                    <img :src="delivery.user ? /storage/+delivery.user.avatar: ''" :alt="delivery.user ? delivery.user.avatar: ''" class="rounded-circle" style="height: 50px;">
                </span>
                <div class="badge text-light rounded-pill bg-success">
                    {{ delivery.user ? delivery.user.name: '' }}
                </div>
            </div>
        </div>
        <!-- Delivery -->
        <div class="row">
            <div class="col">Origen:</div>
            <div class="col-sm">
                <div class="badge text-light rounded-pill bg-info">
                    {{ delivery.origin }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">Punto de recogida:</div>
            <div class="col-sm">
                <div class="badge text-light rounded-pill bg-info">
                    {{ delivery.pick_up_point }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">Destino:</div>
            <div class="col-sm">
                <div class="badge text-light rounded-pill bg-info">
                    {{ delivery.destination }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">Punto de entrega:</div>
            <div class="col-sm">
                <div class="badge text-light rounded-pill bg-info">
                    {{ delivery.delivery_point }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">Tipo de envío:</div>
            <div class="col-sm">
                <div class="badge text-light rounded-pill bg-info">
                    {{ delivery.type }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">Fecha de registro:</div>
            <div class="col-sm">
                <div class="badge text-light rounded-pill bg-info">
                    {{ delivery.date }}
                </div>
            </div>
        </div>
        <!-- Delivery Details -->
        <div class="row">
            <div class="col">Oferta inicial:</div>
            <div class="col-sm">
                <div class="badge text-light rounded-pill bg-info">
                    {{ delivery.detail ? delivery.detail.initial_offer: '' }}
                </div>
            </div>
        </div>

        <!-- Delivery Measures -->
        <div v-if="delivery.type == 'Package'">
            <div class="row">
                <div class="col">Contenido:</div>
                <div class="col-sm">
                    <div class="badge text-light rounded-pill bg-info">
                        {{ delivery.detail ? delivery.detail.content: '' }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">Peso:</div>
                <div class="col-sm">
                    <div class="badge text-light rounded-pill bg-info">
                        {{ delivery.detail ? delivery.detail.size: '' }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">Alto:</div>
                <div class="col-sm">
                    <div class="badge text-light rounded-pill bg-info">
                        {{ delivery.detail ? delivery.detail.hight: '' }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">Largo:</div>
                <div class="col-sm">
                    <div class="badge text-light rounded-pill bg-info">
                        {{ delivery.detail ? delivery.detail.long: '' }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">Ancho:</div>
                <div class="col-sm">
                    <div class="badge text-light rounded-pill bg-info">
                        {{ delivery.detail ? delivery.detail.width: '' }}
                    </div>
                </div>
            </div>
        </div>

        <hr>
        
        <form>
            <label for="offer">Ofertar tarifa</label>
            
            <div class="input-group" :class="{ 'text-danger': $v.offer.$error }">
                <div class="input-group-append">
                    <span class="input-group-text bg-danger border-danger text-white cursor-pointer" @click="operation('decrement')">
                        <i class="fa fa-minus"></i>
                    </span>
                </div>
                <input id="offer" type="number" class="form-control form-control-sm" placeholder="Ofertar tarifa" name="offer" v-model.trim="offer" @input="validateState($event.target.value)"/>
                <div class="input-group-append">
                    <span class="input-group-text bg-success border-success text-white cursor-pointer" @click="operation('increment')">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
            </div>
            
            <div class="text-danger" v-if="$v.offer.$error">Por favor digite una tarifa.</div>
            <div class="text-danger" v-if="!$v.offer.decimal">El campo debe ser númerico.</div>
            <div class="text-info" v-if="!$v.offer.minLength">El campo debe tener mínimo {{ $v.offer.$params.minLength.min }} dígitos.</div>  
        </form>
    </div>
</template>

<script>
    import { required, decimal, minLength } from "vuelidate/lib/validators";

    export default {
        props: {
            delivery: {}
        },
        data() {
            return {
                id: this.$route.params.id,
                offer: 0,
                baseURL: '/delivery/',
            }
        },
        validations() {
            return {
                offer: { required, decimal, minLength: minLength(4) }
            }
        },
        methods: {
            validateState(value) {
                this.offer = value;
                this.$v.offer.$touch();
            },
            acceptDelivery() {
		    	this.$v.offer.$touch();

                if (!this.$v.offer.$anyError) {
                    this.$emit('loading', true);

                    axios.put(this.baseURL + 'offer-shipping-rate', { id:this.id, offer:this.offer }
                        ).then(solve => {
                            toastr.options =
                            {
                                "closeButton" : true,
                                "progressBar" : true
                            }
                            toastr.success(solve.data.message);

                            // Llamado a método de cerrar ventana modal
                            this.closeModal();
                        }).catch(() => {
                            toastr.options =
                            {
                                "closeButton" : true,
                                "progressBar" : true
                            }
                            toastr.error('Ha ocurrido un error interno, por favor intente de nuevo.');
                            
                            this.$emit('loading', false);
                        }
                    );
                }
            },
            closeModal() {

                // Se emite un evento para cerrar la modal
                this.$emit('loading', false);
                this.$emit('hideModal');
            },
            operation(op) {
                if(op == 'increment') {
                    this.offer = parseInt(this.offer + 1000);
                } else if(op == 'decrement' && this.offer >= 1000){
                    this.offer = parseInt(this.offer - 1000);
                }
            }
        }
    }
</script>
