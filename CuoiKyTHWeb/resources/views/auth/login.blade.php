@extends('layouts.app')

@section('content')
<div style="background:#e8f4ff; min-height:100vh;">
    <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">

        <div class="col-md-7">
            <div class="card shadow-sm border-0 rounded-3" style="background:#f7fbff;">

                <!-- Header -->
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h3 class="m-2 fw-bold">{{ __('Login') }}</h3>
                    <a href="{{ route('register') }}" class="text-primary text-decoration-none m-2">
                        Don't have an account?
                    </a>
                </div>

                <div class="card-body">

                    <!-- Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3 row align-items-center">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-7">
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autofocus>

                                @error('email')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3 row align-items-center">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-7">
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required>

                                @error('password')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember -->
                        <div class="mb-3 row">
                            <div class="col-md-7 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember"
                                           {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <div class="row mb-4">
                            <div class="col-md-7 offset-md-4">
                                <button class="btn btn-primary px-4 me-2">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="small">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>

                    <!-- Separator -->
                    <div class="text-center my-3">
                        <div class="d-flex align-items-center">
                            <hr class="flex-grow-1">
                            <span class="mx-2 text-muted small">Login with</span>
                            <hr class="flex-grow-1">
                        </div>
                    </div>

                    <!-- Social Buttons -->
                    <div class="row g-3 mb-3">

                        <!-- Google -->
                        <div class="col-6">
                            <button class="btn bg-light border rounded py-2 w-100 d-flex align-items-center justify-content-center shadow-sm">
                                <img src="../assetAdmin/images/google.svg" class="me-2">
                                <span>Google</span>
                            </button>
                        </div>

                        <!-- Facebook -->
                        <div class="col-6">
                            <button class="btn bg-light border rounded py-2 w-100 d-flex align-items-center justify-content-center shadow-sm">
                                <img src="../assetAdmin/images/facebook.svg" class="me-2">
                                <span>Facebook</span>
                            </button>
                        </div>

                    </div>

                </div> <!-- card-body -->

            </div>
        </div>
    </div>
</div>
@endsection
