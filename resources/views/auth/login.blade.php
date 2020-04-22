@extends('layouts.app', [
    'class' => 'login-page',
    'backgroundImagePath' => 'img/bg/fabio-mangione.jpg'
])

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 ml-auto">
                    <div class="info-area info-horizontal mt-5">
                        <div class="description">
                            <img src="{{asset('img/logo-white.png')}}">
                            <h2 class="description">

                            </h2>
                        </div>
                    </div>
                    <div class="info-area info-horizontal">
                        <div class="description">
                            <h5 class="info-title">The Opportunity Hackathon</h5>
                            <p class="description">
                                Rich in diversity and culture, let’s tap into our innermost potential to create the
                                solutions for our future to make over 400 million talented Africans access to evenly
                                distributed opportunity.
                            </p>
                        </div>
                    </div>
                    <div class="info-area info-horizontal">

                        <div class="description">
                            <div class="social">
                                <a href="https://twitter.com/afrikathon" target="_blank" class="btn btn-icon btn-round btn-twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="https://www.facebook.com/afrikathon" target="_blank" class="btn btn-icon btn-round btn-facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="https://www.instagram.com/afrikathon__/" target="_blank" class="btn btn-icon btn-round btn-dribbble">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Login') }}</h4>
                            <div class="social">
                                <a href="{{ route('social.oauth', 'github') }}"
                                   class="btn btn-github">
                                    <i class="fa fa-github"></i> Login with Github
                                </a>
                               {{-- <a href="{{ route('social.oauth', 'google') }}" class="btn btn-icon btn-round btn-twitter">
                                    <i class="fa fa-google"></i>
                                </a>
                                <a href="{{ route('social.oauth', 'linked') }}" class="btn btn-icon btn-round btn-facebook">
                                    <i class="fa fa-linkedin"></i>
                                </a>--}}
                                <p class="card-description">{{ __('or be classical') }}</p>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('login') }}">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                    </div>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Email') }}" type="email" name="email"
                                           value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                    </div>
                                    <input
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" placeholder="{{ __('Password') }}" type="password"
                                        required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" name="remember" type="checkbox"
                                                   value="" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="form-check-sign"></span>
                                            {{ __('Remember me') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="text-center">
                                        <button type="submit"
                                                class="btn btn-warning btn-round mb-3">{{ __('Sign in') }}</button>
                                    </div>
                                </div>

                            </form>
                            <a href="{{ route('password.request') }}" class="btn btn-link">
                                {{ __('Forgot password') }}
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-link float-right">
                                {{ __('Create Account') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            demo.checkFullPageBackgroundImage();
        });
    </script>
@endpush
