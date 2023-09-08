@extends('layouts.reset-layout')

@section('content')
<div class="row">
    <div class="col-xl-5 col-lg-6 col-md-8 col-12 px-5 d-flex flex-column">
        <div class="card card-plain mt-8">
            <div class="card-header pb-0 text-left">
                <h3 class="text-info text-gradient">Reset Password</h3>
                {{-- <p class="mb-0">You will receive an e-mail in maximum 60 seconds</p> --}}
            </div>
            <div class="card-body pb-3">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <label>{{ __('E-Mail Address') }}</label>
                    <div class="mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <label>{{ __('Password') }}</label>
                    <div class="mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <label>{{ __('Confirm Password') }}</label>
                    <div class="mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">
                        {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('/assets/img/curved-images/curved6.jpg')"></div>
        </div>
    </div>
</div>

@endsection