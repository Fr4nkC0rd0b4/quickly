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
    		<div class="col-lg-6">
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
        data(){
            return{
                result: {message:'',alert:''}
            }
        },
        methods: {
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