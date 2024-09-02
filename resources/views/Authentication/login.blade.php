@extends('Authentication.layouts.master');

@section('content')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 offset-3">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Enter Email Address..." name="email" value="{{old('email')}}">
                                            @error('email')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="exampleInputPassword" placeholder="Password" name="password" value="{{old('password')}}">
                                            @error('password')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </a>
                                    <hr>
                                    <a href="{{url('/auth/github/redirect')}}" class="btn btn-dark btn-user btn-block">
                                        <i class="fa-brands fa-github"></i> Login with Github
                                    </a>
                                    <a href="{{url('/auth/google/redirect')}}" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i>  Login with Google
                                    </a>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{route('userRegister')}}">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
