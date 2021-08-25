<template>
	<div class="container-fluid">
        <header-component title="Editar perfil"></header-component>

        <div style="text-align: left;" v-if="result.message!=''" :class="result.alert" class="alert alert-dismissible fade show" role="alert">
        {{ result.message }}
            <button type="button" @click="result={message:'',alert:''}" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="row justify-content-center">
    		<div class="col-lg-10">
    			<div class="card">
    				<div class="card-body">
    					<form method="POST" id="form">
                            <input type="hidden" name="id" :value="user.id">
    						<div class="form-group">
    							<label for="name" class="">Nombres</label>
    							<input name="name" required type="text" class="is-untouched is-pristine av-invalid form-control" :value="user.name">
    						</div>
                            <div class="form-group">
                                <label for="dni" class="">Cédula</label>
                                <input name="dni" required type="text" class="is-untouched is-pristine av-invalid form-control" :value="user.dni">
                            </div>
    						<div class="form-group">
    							<label for="email" class="">Correo</label>
    							<div class="input-group">
    								<div class="input-group-prepend">
    									<span class="input-group-text">@</span>
    								</div>
    								<input placeholder="Correo" name="email" required id="email" type="text" class="is-untouched is-pristine av-invalid form-control" :value="user.email">
    								<div class="valid-feedback">Por favor escoga un nombre de usuario.</div>
    							</div>
    						</div>
    						<div class="form-group">
    							<label for="password" class="">Contraseña</label>
    							<input name="password" required id="password" type="password" class="is-untouched is-pristine av-invalid form-control">
    						</div>
                            <hr>
                            <!-- Location Information -->
                            <div class="form-group">
                                <label for="country">Pais</label>
                                <input id="country" type="text" name="country" class="is-untouched is-pristine av-invalid form-control" :value="info.locations.country">
                            </div>
                            <div class="form-group">
                                <label for="state">Departamento</label>
                                <input id="state" type="text" name="state" class="is-untouched is-pristine av-invalid form-control" :value="info.locations.state">
                            </div>
                            <div class="form-group">
                                <label for="city">Ciudad</label>
                                <input id="city" type="text" name="city" class="is-untouched is-pristine av-invalid form-control" :value="info.locations.city">
                            </div>
                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <input id="address" type="text" name="address" class="is-untouched is-pristine av-invalid form-control" :value="info.locations.address">
                            </div>
                            <div class="form-group">
                                <label for="neighborhood">Barrio</label>
                                <input id="neighborhood" type="text" name="neighborhood" class="is-untouched is-pristine av-invalid form-control" :value="info.locations.neighborhood">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="name_owner">Nombre del Titular</label>
                                <input id="name_owner" placeholder="Como aparece en la tarjeta" type="text" name="name_owner" class="is-untouched is-pristine av-invalid form-control" :value="info.payment_methods.name_owner">
                            </div>
                            <div class="form-group">
                                <label for="last_name_owner">Apellido del Titular</label>
                                <input id="last_name_owner" placeholder="Como aparece en la tarjeta" type="text" name="last_name_owner" class="is-untouched is-pristine av-invalid form-control" :value="info.payment_methods.last_name_owner">
                            </div>
                            <div class="form-group">
                                <label for="card_type">Apellido del Titular</label>
                                <select id="card_type" name="card_type" class="is-untouched is-pristine av-invalid form-control" :value="info.payment_methods.card_type">
                                    <option>TC</option>
                                    <option>TD</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="card_number">Número de tarjeta</label>
                                <input id="card_number" placeholder="**** **** **** ****" name="card_number" class="is-untouched is-pristine av-invalid form-control" :value="info.payment_methods.card_number">
                            </div>
                            <div class="form-group">
                                <label for="expiration_month">Mes de expiración</label>
                                <select id="expiration_month" name="expiration_month" class="is-untouched is-pristine av-invalid form-control" :value="info.payment_methods.expiration_month">
                                    <option></option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="expiration_month">Año de expiración</label>
                                <select id="expiration_month" name="expiration_month" class="is-untouched is-pristine av-invalid form-control" :value="info.payment_methods.expiration_year">
                                    <option></option>
                                    <option>21</option>
                                    <option>22</option>
                                    <option>23</option>
                                    <option>24</option>
                                    <option>25</option>
                                    <option>26</option>
                                    <option>27</option>
                                    <option>28</option>
                                    <option>29</option>
                                    <option>30</option>
                                    <option>31</option>
                                    <option>32</option>
                                </select>
                            </div>
                            <hr>
    						<div class="form-group">
    							<div class="is-untouched is-pristine av-invalid custom-checkbox custom-control">
    								<input type="checkbox" name="customCheckbox" required id="customCheckbox" class="custom-control-input" value="false">
    								<label class="custom-control-label" for="customCheckbox">Acepto los términos y condiciones</label>
    							</div>
    						</div>
    						<button type="button" class="btn btn-primary" @click="updateProfile">Guardar</button>
    					</form>
    				</div>
    			</div>
    		</div>
        </div>
    </div>
</template>

<script>
    let user = document.head.querySelector('meta[name="user"]');

    export default {
        computed: {
            user(){
                return JSON.parse(user.content);
            }
        },
        mounted() {
            this.getUserInfo();
        },
        data(){
            return{
                info: [],
                result: {message:'',alert:''}
            }
        },
        methods: {
            getUserInfo() {
                axios.get('/account/profile/' + this.user.id
                    ).then(solve => {
                        this.info = solve.data;
                        console.log('Cargado')
                    }).catch(solve => {
                        console.log("no cargado")
                    }
                );
            },
            updateProfile: function() {
                let data = $('#form').serialize()
                axios.post('/profile/update', data
                    ).then(function(){
                        this.result={message:'Perfil actualizado correctamente',alert:'alert-success'}
                    })
                    .catch(function(){
                        this.result={message:'Ha ocurrido un error, por favor intente de nuevo',alert:'alert-danger'}
                    }
                );
            }
        }
    }
</script>