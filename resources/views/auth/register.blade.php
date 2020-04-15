@extends('layouts.app', [
    'class' => 'register-page',
    'backgroundImagePath' => 'img/bg/jan-sendereks.jpg'
])

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 ml-auto">
                    <div class="info-area info-horizontal mt-5">
                        <div class="description">
                            <img src="https://afrikathon.org/wp-content/uploads/2020/04/logo-white.png">
                            <h2 class="description">
                                The Opportunity Hackathon
                            </h2>
                        </div>
                    </div>
                    <div class="info-area info-horizontal">
                        <div class="description">
                            <h5 class="info-title">HACK THE LABOUR SYSTEM</h5>
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
                                <button class="btn btn-icon btn-round btn-gtihub">
                                    <i class="fa fa-github"></i>
                                </button>
                                <button class="btn btn-icon btn-round btn-twitter">
                                    <i class="fa fa-google"></i>
                                </button>
                                <button class="btn btn-icon btn-round btn-facebook">
                                    <i class="fa fa-linkedin"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Register') }}</h4>
                            <div class="social">
                                <a href="{{ route('social.oauth', 'github') }}" class="btn btn-icon btn-round btn-gtihub">
                                    <i class="fa fa-github"></i>
                                </a>
                                <a href="{{ route('social.oauth', 'google') }}" class="btn btn-icon btn-round btn-twitter">
                                    <i class="fa fa-google"></i>
                                </a>
                                <a href="{{ route('social.oauth', 'linked') }}" class="btn btn-icon btn-round btn-facebook">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                                <p class="card-description">{{ __('or be classical') }}</p>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('register') }}">
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
                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-single-02"></i>
                                        </span>
                                    </div>
                                    <input name="name" type="text" class="form-control" placeholder="Name"
                                           value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-email-85"></i>
                                        </span>
                                    </div>
                                    <input name="email" type="email" class="form-control" placeholder="Email" required
                                           value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-key-25"></i>
                                        </span>
                                    </div>
                                    <input name="password" type="password" class="form-control" placeholder="Password"
                                           required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-key-25"></i>
                                        </span>
                                    </div>
                                    <input name="password_confirmation" type="password" class="form-control"
                                           placeholder="Password confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-check text-left">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="agree_terms_and_conditions"
                                               type="checkbox">
                                        <span class="form-check-sign"></span>
                                        {{ __('I agree to the') }}
                                        <a href="#something">{{ __('terms and conditions') }}</a>.
                                    </label>
                                    @if ($errors->has('agree_terms_and_conditions'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('agree_terms_and_conditions') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="card-footer ">
                                    <button type="submit"
                                            class="btn btn-info btn-round">{{ __('Get Started') }}</button>
                                </div>
                            </form>
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
