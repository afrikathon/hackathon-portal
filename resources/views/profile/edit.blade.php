@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('profile.update') }}" class="form-horizontal" autocomplete="off"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class=" card card-user">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Edit Profile') }}
                                <span> <a href="{{ route('social.oauth', 'github') }}"
                                          class="pull-right btn btn-primary btn-sm"
                                          style="margin: 0; font-size: small ">
                                    <img src="https://pngimg.com/uploads/github/github_PNG20.png" width="30px"> Update with Github
                                    </a></span>

                            </h4>
                        </div>
                        <div class="card-body">

                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="row pull-right">
                                        <div class="text-center">
                                            <div class="kv-avatar">
                                                <div class="file-loading">
                                                    <input id="avatar-1" name="avatar" type="file">
                                                </div>
                                            </div>
                                            <div class="kv-avatar-hint">
                                                <small>Select file < 1500 KB</small>
                                            </div>
                                        </div>
                                        <div id="kv-avatar-errors-1" class="center-block"
                                             style="width:800px;display:none"></div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                    name="name" id="input-name" type="text"
                                                    placeholder="{{ __('Name') }}"
                                                    value="{{ old('name', auth()->user()->name) }}"
                                                    required="true"
                                                    aria-required="true"/>
                                                @if ($errors->has('name'))
                                                    <span id="name-error" class="error text-danger"
                                                          for="input-name">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                    name="email" id="input-email" type="text"
                                                    placeholder="{{ __('Email') }}"
                                                    value="{{ old('email', auth()->user()->email) }}"
                                                    required="true"
                                                    aria-required="true"/>
                                                @if ($errors->has('email'))
                                                    <span id="email-error" class="error text-danger"
                                                          for="input-email">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                                    name="username" id="input-username" type="text"
                                                    placeholder="{{ __('Username') }}"
                                                    value="{{ old('email', auth()->user()->username) }}"
                                                    required="true"
                                                    aria-required="true"/>
                                                @if ($errors->has('username'))
                                                    <span id="username-error" class="error text-danger"
                                                          for="input-username">{{ $errors->first('username') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div
                                                class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                    name="phone" type="text" placeholder="{{ __('phone') }}"
                                                    value="{{ old('phone', auth()->user()->phone) }}" required/>
                                                @if ($errors->has('phone'))
                                                    <span id="email-error" class="error text-danger"
                                                          for="input-email">{{ $errors->first('phone') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div
                                                class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                                                    name="country" type="text"
                                                    placeholder="{{ __('Country') }}"
                                                    value="{{ old('country', auth()->user()->country) }}"/>
                                                @if ($errors->has('country'))
                                                    <span id="country-error" class="error text-danger"
                                                          for="input-country">{{ $errors->first('country') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div
                                                class="form-group{{ $errors->has('city') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                                                    name="location" type="text"
                                                    placeholder="{{ __('City') }}"
                                                    value="{{ old('city', auth()->user()->city) }}"/>
                                                @if ($errors->has('city'))
                                                    <span id="city-error" class="error text-danger"
                                                          for="input-city">{{ $errors->first('city') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div
                                                class="form-group{{ $errors->has('github') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('github') ? ' is-invalid' : '' }}"
                                                    name="github" type="text" placeholder="{{ __('Github URL') }}"
                                                    value="{{ old('github', auth()->user()->github) }}" required/>
                                                @if ($errors->has('github'))
                                                    <span id="email-error" class="error text-danger"
                                                          for="input-email">{{ $errors->first('github') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div
                                                class="form-group{{ $errors->has('linkedin') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('linkedin') ? ' is-invalid' : '' }}"
                                                    name="linkedin" type="text"
                                                    placeholder="{{ __('Linkedin URL') }}"
                                                    value="{{ old('linkedin', auth()->user()->linkedin) }}"/>
                                                @if ($errors->has('linkedin'))
                                                    <span id="linkedin-error" class="error text-danger"
                                                          for="input-linkedin">{{ $errors->first('linkedin') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div
                                                class="form-group{{ $errors->has('facebook') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}"
                                                    name="location" type="text"
                                                    placeholder="{{ __('Facebook URL') }}"
                                                    value="{{ old('facebook', auth()->user()->facebook) }}"/>
                                                @if ($errors->has('facebook'))
                                                    <span id="facebook-error" class="error text-danger"
                                                          for="input-facebook">{{ $errors->first('facebook') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div
                                                class="form-group{{ $errors->has('twitter') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('twitter') ? ' is-invalid' : '' }}"
                                                    name="location" type="text"
                                                    placeholder="{{ __('Twitter URL') }}"
                                                    value="{{ old('twitter', auth()->user()->twitter) }}"/>
                                                @if ($errors->has('twitter'))
                                                    <span id="twitter-error" class="error text-danger"
                                                          for="input-twitter">{{ $errors->first('twitter') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div
                                                class="form-group{{ $errors->has('job_role') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('job_role') ? ' is-invalid' : '' }}"
                                                    name="job_role" type="text" placeholder="{{ __('Role e.g UX/UI Engineer, Full Stuck Developer') }}"
                                                    value="{{ old('job_role', auth()->user()->job_role) }}" required/>
                                                @if ($errors->has('job_role'))
                                                    <span id="email-error" class="error text-danger"
                                                          for="input-email">{{ $errors->first('job_role') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div
                                                class="form-group{{ $errors->has('experience') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('experience') ? ' is-invalid' : '' }}"
                                                    name="experience" type="text"
                                                    placeholder="{{ __('Years of Experience') }}"
                                                    value="{{ old('experience', auth()->user()->experience) }}"/>
                                                @if ($errors->has('experience'))
                                                    <span id="experience-error" class="error text-danger"
                                                          for="input-experience">{{ $errors->first('experience') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div
                                                class="form-group{{ $errors->has('website') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}"
                                                    name="location" type="text"
                                                    placeholder="{{ __('Portfolio/ Website') }}"
                                                    value="{{ old('website', auth()->user()->website) }}"/>
                                                @if ($errors->has('website'))
                                                    <span id="website-error" class="error text-danger"
                                                          for="input-website">{{ $errors->first('website') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div
                                                class="form-group{{ $errors->has('twitter') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('twitter') ? ' is-invalid' : '' }}"
                                                    name="location" type="text"
                                                    placeholder="{{ __('Twitter URL') }}"
                                                    value="{{ old('twitter', auth()->user()->twitter) }}"/>
                                                @if ($errors->has('twitter'))
                                                    <span id="twitter-error" class="error text-danger"
                                                          for="input-twitter">{{ $errors->first('twitter') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                                    <div
                                                        class="form-group{{ $errors->has('bio') ? ' has-danger' : '' }}">
                                                <textarea
                                                    class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}"
                                                    name="bio" type="text" placeholder="{{ __('Bio') }}"
                                                    value="{{ old('bio', auth()->user()->bio) }}"></textarea>
                                                        @if ($errors->has('bio'))
                                                            <span id="email-error" class="error text-danger"
                                                                  for="input-email">{{ $errors->first('bio') }}</span>
                                                        @endif
                                                    </div>
                                        </div>
                                        <div class="col-md-6">
                                                    <div
                                                        class="form-group{{ $errors->has('skills') ? ' has-danger' : '' }}">
                                                <textarea
                                                    class="form-control{{ $errors->has('skills') ? ' is-invalid' : '' }}"
                                                    name="skills" type="text" placeholder="{{ __('Bio') }}"
                                                    value="{{ old('skills', auth()->user()->skills) }}"></textarea>
                                                        @if ($errors->has('skills'))
                                                            <span id="email-error" class="error text-danger"
                                                                  for="input-email">{{ $errors->first('skills') }}</span>
                                                        @endif
                                                    </div>
                                        </div>
                                    </div>


                                </div>
                            </div>


                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/plugins/piexif.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/plugins/sortable.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/locales/fr.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/locales/es.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/fas/theme.js')}}" type="text/javascript"></script>
    <script src="{{asset('themes/explorer-fas/theme.js')}}" type="text/javascript"></script>

    <!-- the fileinput plugin initialization -->
    <script>
        $("#avatar-1").fileinput({
            theme: 'fas',
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            browseLabel: '',
            removeLabel: '',
            browseIcon: '<i class="fa fa-folder-open"></i>',
            removeIcon: '<i class="fa fa-trash"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',
            defaultPreviewContent: '<img  style="width: 200px" src="{{Auth::user()->avatar}}" alt="Your Avatar">',
            layoutTemplates: {main2: '{preview}  {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif"]
        });
    </script>
@endsection
@section('style')
    <link href="{{asset('css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
    <link href="{{asset('themes/explorer-fas/theme.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <style>
        .kv-avatar .krajee-default.file-preview-frame, .kv-avatar .krajee-default.file-preview-frame:hover {
            margin: 0;
            padding: 0;
            border: none;
            box-shadow: none;
            text-align: center;
        }

        .kv-avatar {
            display: inline-block;
        }

        .kv-avatar .file-input {
            display: table-cell;
            width: 213px;
        }

        .kv-reqd {
            color: red;
            font-family: monospace;
            font-weight: normal;
        }
    </style>
@endsection
