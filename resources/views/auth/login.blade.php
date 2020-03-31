@extends('layouts.auth', ['title' => 'Kirish'])

@section('content')

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">@lang('Welcome!')</h1>
                  </div>
                  <form class="user" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input name="email" type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Pochta manzilingizni kiriting..." value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="password" placeholder="Parol..." type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customCheck">{{ __('Remember me') }}</label>
                      </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="{{ route('register') }}">{{ __('Create an Account!') }}</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

@endsection
