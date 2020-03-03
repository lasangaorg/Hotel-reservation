{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>--}}

{{--                    <div class="card-body">--}}
{{--                        @if (session('resent'))--}}
{{--                            <div class="alert alert-success" role="alert">--}}
{{--                                {{ __('A fresh verification link has been sent to your email address.') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                        {{ __('Before proceeding, please check your email for a verification link.') }}--}}
{{--                        {{ __('If you did not receive the email') }},--}}
{{--                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">--}}
{{--                            @csrf--}}
{{--                            <button type="submit"--}}
{{--                                    class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>--}}
{{--                            .--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}








@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                <h3 class="login-heading mb-4">Verify Account!</h3>
                                @if(count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        @foreach($errors->all() as $error)
                                            <p class="mb-0">{{$error}}</p>
                                        @endforeach
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('verifyTwoFactor') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="username"
                                               class="col-md-12 col-form-label">{{ __('VerificationCode') }}</label>

                                        <div class="col-md-12">
                                            <input id="code" type="text"
                                                   class="form-control @error('code') is-invalid @enderror" name="code"
                                                   value="{{ old('code') }}" autocomplete="code" autofocus>

                                            <input hidden name="userId" value="{{$userId}}">

                                            @error('code')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-block btn-primary">
                                                {{ __('Verify') }}
                                            </button>
                                        </div>
                                        <a class="btn btn-link text-center" href="{{ route('resend', ['userid' => $userId]) }}">
                                            {{ __('Resend verification code') }}
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

