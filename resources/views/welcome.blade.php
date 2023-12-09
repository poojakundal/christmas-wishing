@extends('layouts.simple-app')

@section('title')
    {{ __('Home') }}
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4"></h4>

    <div class="row">
        <!-- Headings -->
        <div class="col-md-3">
        </div>
        <div class="col-md-3">
            <div class="card mb-3">
                <h5 class="card-header">Already a member?</h5>
                <div class="card-body text-center">
                    <small class="text-light fw-medium mb-3">Login to access your account and explore amazing features.</small>
                    <div class="mt-3">
                        <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Customizing headings -->
        <div class="col-md-3">
            <div class="card mb-3">
                <h5 class="card-header">Join us today!</h5>
                <div class="card-body text-center">
                    <small class="text-light fw-medium mb-3">Create a new account to get started with our platform.</small>
                    <div class="mt-3">
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    </div>  
                </div>
            </div>
        </div>  
        <div class="col-md-3">
        </div>
    </div>
</div>
@endsection
