@extends('layouts.app')

@section('page-content')
<div class="kt-login__actions" style="float:right">
    <button id="kt_login_signin_submit" class="btn btn-primary btn-elevate kt-login__btn-primary" onclick="window.location='{{ url("register") }}'">Register</button>
</div>
 <!--begin::Body-->
 <div class="kt-login__body">
 
<!--begin::Signin-->
<div class="kt-login__form">
    <div class="kt-login__title">
        <h3>Login</h3>
    </div>

    <!--begin::Form-->
    <form class="kt-form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group form-group">
            <input class="form-control @error('email') is-invalid @enderror"  type="email" placeholder="Email" name="email" required autocomplete="off" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group form-group">
           <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
       
        <div class="kt-login__actions">
            <button id="kt_login_signin_submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Login Now</button>
        </div>
      
    </form>
    <!--end::Form-->
    
        

    <!--begin::Divider-->

    <!--end::Divider-->

    <!--begin::Options-->

    <!--end::Options-->
</div>
<!--end::Signin-->
</div>
<!--end::Body-->

@endsection
