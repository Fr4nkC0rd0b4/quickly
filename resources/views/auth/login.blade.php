@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border-info">
                <img src="{{ asset('img/logo-dark.png') }}" class="card-img-top" alt="...">
                <div class="dropdown-divider"></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="user">{{ __('Usuario:') }}</label>

                            <input id="user" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Contraseña:') }}</label>
                            
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Recordarme') }}
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary col mt-4">
                                    {{ __('Iniciar') }}
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="dropdown-divider"></div>
                <div class="form-group">
                    @if (Route::has('password.request'))
                        <a class="dropdown-item" href="{{ route('password.request') }}">
                            {{ __('Olvidé mi contraseña') }}
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a class="dropdown-item" href="{{ route('register') }}">¿Nuevo por aquí? Resgistrarse</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
