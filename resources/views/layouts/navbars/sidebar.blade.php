<div class="sidebar" data="blue">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini"><img
                    src="https://avatars3.githubusercontent.com/u/60590865?s=400&u=f58982a36d24b2c0cb249f69bc09e93442bcdf4c&v=4"></a>
            <a href="#" class="simple-text logo-normal">{{ __('Afrikarthon') }}</a>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="image">
                    <img src="{{ asset('paper/img/damir-bosnjak.jpg') }}" alt="...">
                </div>
                <div class="card-body">
                    <div class="author">
                        <a href="#">
                            <img class="avatar border-gray" src="{{ asset('paper/img/mike.jpg') }}" alt="...">

                            <h5 class="title">{{ __(auth()->user()->name)}}</h5>
                        </a>
                        <p class="description">
                            @ {{ __(auth()->user()->name)}}
                        </p>
                    </div>
                    <p class="description text-center">
                        {{ __('I like the way you work it') }}
                        <br> {{ __('No diggity') }}
                        <br> {{ __('I wanna bag it up') }}
                    </p>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="button-container">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-6 ml-auto">
                                <h5>{{ __('12') }}
                                    <br>
                                    <small>{{ __('Files') }}</small>
                                </h5>
                            </div>
                            <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                <h5>{{ __('2GB') }}
                                    <br>
                                    <small>{{ __('Used') }}</small>
                                </h5>
                            </div>
                            <div class="col-lg-3 mr-auto">
                                <h5>{{ __('24,6$') }}
                                    <br>
                                    <small>{{ __('Spent') }}</small>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Team Members') }}</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled team-members">
                        <li>
                            <div class="row">
                                <div class="col-md-2 col-2">
                                    <div class="avatar">
                                        <img src="{{ asset('paper/img/faces/ayo-ogunseinde-2.jpg') }}" alt="Circle Image"
                                             class="img-circle img-no-padding img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-7 col-7">
                                    {{ __('DJ Khaled') }}
                                    <br />
                                    <span class="text-muted">
                                            <small>{{ __('Offline') }}</small>
                                        </span>
                                </div>
                                <div class="col-md-3 col-3 text-right">
                                    <button class="btn btn-sm btn-outline-success btn-round btn-icon"><i
                                            class="fa fa-envelope"></i></button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-2 col-2">
                                    <div class="avatar">
                                        <img src="{{ asset('paper/img/faces/joe-gardner-2.jpg') }}" alt="Circle Image"
                                             class="img-circle img-no-padding img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-7 col-7">
                                    {{ __('Creative Tim') }}
                                    <br />
                                    <span class="text-success">
                                            <small>{{ __('Available') }}</small>
                                        </span>
                                </div>
                                <div class="col-md-3 col-3 text-right">
                                    <button class="btn btn-sm btn-outline-success btn-round btn-icon"><i
                                            class="fa fa-envelope"></i></button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-2 col-2">
                                    <div class="avatar">
                                        <img src="{{ asset('paper/img/faces/clem-onojeghuo-2.jpg') }}" alt="Circle Image"
                                             class="img-circle img-no-padding img-responsive">
                                    </div>
                                </div>
                                <div class="col-ms-7 col-7">
                                    {{ __('Flume') }}
                                    <br />
                                    <span class="text-danger">
                                            <small>{{ __('Busy') }}</small>
                                        </span>
                                </div>
                                <div class="col-md-3 col-3 text-right">
                                    <button class="btn btn-sm btn-outline-success btn-round btn-icon"><i
                                            class="fa fa-envelope"></i></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
           {{-- <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="false">
                    <i class="fab fa-laravel"></i>
                    <span class="nav-link-text">{{ __('God Mode') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('User Management') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>--}}
            <li @if ($pageSlug == 'profile') class="active " @endif>
                <a href="{{ route('profile.edit')  }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ __('User Profile') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
