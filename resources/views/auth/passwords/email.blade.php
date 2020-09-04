@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border-info">
                <img src="/storage/{{ setting('site.logo_dark') }}" class="card-img-top" alt="logo">
                <div class="dropdown-divider"></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="user">{{ __('Correo Eléctronico:') }}</label>
                            
                            <input id="user" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary col">
                                {{ __('Enviar Link de restablecimiento') }}
                            </button>

                            <button onclick="history.back();" class="btn btn-secondary col mt-2">
                                {{ __('Volver') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
