@extends('layouts.app')

@section('content')
<!-- Start Content-->
{{-- <div class="container-fluid"> --}}
	<!-- start page title -->
    {{-- <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div> --}}
    <!-- end page title -->
    {{-- <div class="row justify-content-center"> --}}
        <router-view></router-view>
    {{-- </div> --}}
{{-- </div> --}}
@endsection
