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
                            <img src="https://afrikathon.org/wp-content/uploads/2020/04/logo-white.png" width="70%">
                            <h3 class="description">
                                Late Registration Ends : May 08, 2020
                            </h3>
                        </div>
                    </div>
                    <div class="info-area info-horizontal">
                        <div class="description">
                            <h5 class="info-title">The Opportunity Hackathon</h5>
                            <p class="description">
                                Signup for our Virtual Event where you’d learn design thinking, form a team across the
                                continent and build a tech solution to create opportunities for over 400 million
                                talented Africans and win cool prizes.
                            </p>
                        </div>
                    </div>
                    <div class="info-area info-horizontal">

                        <div class="description">
                            <div class="social">
                                <a href="https://twitter.com/afrikathon" target="_blank"
                                   class="btn btn-icon btn-round btn-twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="https://www.facebook.com/afrikathon" target="_blank"
                                   class="btn btn-icon btn-round btn-facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="https://www.instagram.com/afrikathon__/" target="_blank"
                                   class="btn btn-icon btn-round btn-dribbble">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Register') }}</h4>
                            <div class="social">
                                <a href="{{ route('social.oauth', 'github') }}"
                                   class="btn btn-github">
                                    <i class="fa fa-github"></i> Register with Github
                                </a>
                                {{-- <a href="{{ route('social.oauth', 'google') }}" class="btn btn-icon btn-round btn-twitter">
                                     <i class="fa fa-google"></i>
                                 </a>
                                 <a href="{{ route('social.oauth', 'linked') }}" class="btn btn-icon btn-round btn-facebook">
                                     <i class="lfa fa-linkedin"></i>
                                 </a>--}}
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
                                <div class="input-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-globe"></i>
                                        </span>
                                    </div>
                                    <select name="country" type="" class="form-control" required>
                                        <option readonly disabled selected>--- Select country ---</option>
                                        <option id="DZ" value="Algeria">Algeria</option>
                                        <option id="AO" value="Angola">Angola</option>
                                        <option id="BJ" value="Benin">Benin</option>
                                        <option id="BW" value="Botswana">Botswana</option>
                                        <option id="BF" value="Burkina Faso">Burkina Faso</option>
                                        <option id="BI" value="Burundi">Burundi</option>
                                        <option id="CM" value="Cameroon">Cameroon</option>
                                        <option id="CV" value="Cape Verde">Cape Verde</option>
                                        <option id="CF" value="Central African Republic">Central African Republic
                                        </option>
                                        <option id="TD" value="Chad">Chad</option>
                                        <option id="KM" value="Comoros">Comoros</option>
                                        <option id="CG" value="Congo - Brazzaville">Congo - Brazzaville</option>
                                        <option id="CD" value="Congo - Kinshasa">Congo - Kinshasa</option>
                                        <option id="CI" value="Côte d’Ivoire">Côte d’Ivoire</option>
                                        <option id="DJ" value="Djibouti">Djibouti</option>
                                        <option id="EG" value="Egypt">Egypt</option>
                                        <option id="GQ" value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option id="ER" value="Eritrea">Eritrea</option>
                                        <option id="ET" value="Ethiopia">Ethiopia</option>
                                        <option id="GA" value="Gabon">Gabon</option>
                                        <option id="GM" value="Gambia">Gambia</option>
                                        <option id="GH" value="Ghana">Ghana</option>
                                        <option id="GN" value="Guinea">Guinea</option>
                                        <option id="GW" value="Guinea-Bissau">Guinea-Bissau</option>
                                        <option id="KE" value="Kenya">Kenya</option>
                                        <option id="LS" value="Lesotho">Lesotho</option>
                                        <option id="LR" value="Liberia">Liberia</option>
                                        <option id="LY" value="Libya">Libya</option>
                                        <option id="MG" value="Madagascar">Madagascar</option>
                                        <option id="MW" value="Malawi">Malawi</option>
                                        <option id="ML" value="Mali">Mali</option>
                                        <option id="MR" value="Mauritania">Mauritania</option>
                                        <option id="MU" value="Mauritius">Mauritius</option>
                                        <option id="YT" value="Mayotte">Mayotte</option>
                                        <option id="MA" value="Morocco">Morocco</option>
                                        <option id="MZ" value="Mozambique">Mozambique</option>
                                        <option id="NA" value="Namibia">Namibia</option>
                                        <option id="NE" value="Niger">Niger</option>
                                        <option id="NG" value="Nigeria">Nigeria</option>
                                        <option id="RW" value="Rwanda">Rwanda</option>
                                        <option id="RE" value="Réunion">Réunion</option>
                                        <option id="SH" value="Saint Helena">Saint Helena</option>
                                        <option id="SN" value="Senegal">Senegal</option>
                                        <option id="SC" value="Seychelles">Seychelles</option>
                                        <option id="SL" value="Sierra Leone">Sierra Leone</option>
                                        <option id="SO" value="Somalia">Somalia</option>
                                        <option id="ZA" value="South Africa">South Africa</option>
                                        <option id="SD" value="Sudan">Sudan</option>
                                        <option id="SZ" value="Swaziland">Swaziland</option>
                                        <option id="ST" value="São Tomé and Príncipe">São Tomé and Príncipe</option>
                                        <option id="TZ" value="Tanzania">Tanzania</option>
                                        <option id="TG" value="Togo">Togo</option>
                                        <option id="TN" value="Tunisia">Tunisia</option>
                                        <option id="UG" value="Uganda">Uganda</option>
                                        <option id="EH" value="Western Sahara">Western Sahara</option>
                                        <option id="ZM" value="Zambia">Zambia</option>
                                        <option id="ZW" value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                    @if ($errors->has('country'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('country') }}</strong>
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
                                        <a href="https://afrikathon.org/tandc"
                                           target="_blank">{{ __('terms and conditions') }}</a>.
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
