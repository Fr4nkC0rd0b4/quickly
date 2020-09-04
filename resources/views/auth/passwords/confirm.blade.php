@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border-info">
                <img src="/storage/{{ setting('site.logo_dark') }}" class="card-img-top" alt="logo">
                <div class="dropdown-divider"></div>

                <div class="card-body">
                    {{ __('Por favor confirma tu contraseña para continuar.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

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
                            <button type="submit" class="btn btn-primary col">
                                {{ __('Confirmar Contraseña') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link col" href="{{ route('password.request') }}">
                                    {{ __('Olvidé mi contraseña') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
