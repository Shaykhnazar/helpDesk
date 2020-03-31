@extends('layouts.auth', ['title' => 'Register'])

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">{{ __('Register') }}</h1>
                        </div>
                        <form class="user" method="POST" action="{{ route('register') }}">
                        @csrf
                            <div class="form-group">
                                <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" placeholder="Name"  required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email"  required autocomplete="email"  placeholder="Enter Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input id="password" type="password" class="form-control form-control-user  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" >
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat Password">
                                </div>
                            </div>

                            <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Register') }}
                                    </button>
                            </div>
                            <hr>
                        </form>
                        <hr>
{{--                         <div class="text-center">
                            @if (Route::has('password.request'))
                            <a class="small" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div> --}}
                        <div class="text-center">
                            <a class="small" href="{{ route('login') }}">{{ __('Already have an account? Login!') }}</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
