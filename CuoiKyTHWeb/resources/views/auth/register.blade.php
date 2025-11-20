@extends('layouts.app')

@section('content')
<div style="background:#e8f4ff; min-height:100vh;">
    <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">

        <div class="col-md-7">
            <div class="card shadow-sm border-0 rounded-3" style="background:#f7fbff;">
                    <!-- Header -->
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h3 class="m-2 fw-bold">{{ __('Register') }}</h3>
                    <a href="{{ route('login') }}" class="text-primary text-decoration-none m-2">
                        Already have an account?
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
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
</div>
@endsection
