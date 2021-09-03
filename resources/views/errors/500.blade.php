@extends('layouts.default')

@section('content')
	<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">
                        <!-- Logo -->
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <a href="{{ url('home') }}">
                                <span><img src="{{ asset('storage/'.setting('site.logo')) }}" alt="" height="18"></span>
                            </a>
                        </div>
                        
                        <div class="card-body p-4">

                            <div class="text-center">
                                <img src="{{ asset('storage/'.setting('site.error_500')) }}" height="120" alt="File not found Image">

                                <h1 class="text-error mt-4">500</h1>
                                <h4 class="text-uppercase text-danger mt-3">Internal Server Error</h4>
                                <p class="text-muted mt-3">¿Por qué no intentas actualizar tu página? o puede ponerse en contacto con el <a href="" class="text-muted"><b>Soporte</b></a></p>

                                <a class="btn btn-info mt-3" href="{{ url('home') }}"><i class="fa fa-reply"></i> Voler al inicio</a>
                            </div>

                        </div> <!-- end card-body-->
                    </div>
                    <!-- end card-->
                    
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt">
        2019 - 2021 Technovations B&C S.A.S - technovations.com
    </footer>
@endsection