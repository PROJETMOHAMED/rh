@extends('errors.layout')
@section("title" , "500")
@section('content')
    <!-- Main-error-wrapper -->
    <div class="main-error-wrapper  page page-h ">
        <img src="{{ asset('assets/img/media/500.png') }} " class="error-page" alt="error">
        <h2>Oopps. The page you were looking for doesn't exist.</h2>
        <h6>You may have mistyped the address or the page may have moved.</h6><a class="btn btn-outline-danger"
            href="{{ route('admin.home') }}">Back to Home</a>
    </div>
    <!-- /Main-error-wrapper -->
@endsection
