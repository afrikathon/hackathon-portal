{{--
@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('password_status'))
            <div class="alert alert-success" role="alert">
                {{ session('password_status') }}
            </div>
        @endif
        <div class="row">
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
            <div class="col-md-8 text-center">
                <form class="col-md-12" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('Edit Profile') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Name') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ auth()->user()->name }}" required>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Email') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ auth()->user()->email }}" required>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="col-md-12" action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('Change Password') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Old Password') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="old_password" class="form-control" placeholder="Old password" required>
                                    </div>
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('New Password') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Password Confirmation') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection--}}
@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('img/logo_l.jpg') }}" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">

                            <img class="avatar border-gray" src="{{ auth()->user()->avatar}}" alt="...">

                            <h5 class="title mb-0">{{ __(auth()->user()->name)}}</h5>
                            <p class="mb-0">{{ __(auth()->user()->email)}}</p>

                            <p class="description mb-0">
                                <i class="fa fa-marker"></i> {{ __(auth()->user()->city)}},{{auth()->user()->country}}
                            </p>
                            <p class="description mb-0">
                                {{ __(auth()->user()->bio)}}
                            </p>

                            <div class="social">
                                @if(auth()->user()->github != "")
                                    <a href="{{ auth()->user()->github }}" target="_blank"
                                       class="btn btn-icon btn-round btn-gtihub">
                                        <i class="fa fa-github"></i>
                                    </a>
                                @endif
                                @if(auth()->user()->linkedin != "")
                                    <a href="{{ auth()->user()->linkedin }}"
                                       target="_blank"
                                       class="btn btn-icon btn-round btn-twitter">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                @endif
                                @if(auth()->user()->twitter != "")
                                    <a href="{{ auth()->user()->twitter }}"
                                       target="_blank"
                                       class="btn btn-icon btn-round btn-twitter">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                @endif
                                @if(auth()->user()->facebook != "")
                                    <a href="{{auth()->user()->facebook }}"
                                       target="_blank"
                                       class="btn btn-icon btn-round btn-facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                @endif
                                @if(auth()->user()->website != "")
                                    <a href="{{auth()->user()->website }}"
                                       target="_blank"
                                       class="btn btn-icon btn-round btn-dribbble">
                                        <i class="fa fa-globe"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <p class="description text-center">

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title">{{ __('Technical Skills') }}</h4>
                        <p> {{auth()->user()->skills}}</p>
                        <br>
                        <h4 class="card-title">{{ __('Language Activity') }} <img src="https://i.ytimg.com/vi/ptK9-CNms98/maxresdefault.jpg" style="width: 90px"></h4>
                        <canvas id="chartEmail"></canvas>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="button-container">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-6 ml-auto">
                                    <h5>{{auth()->user()->public_repos}}
                                        <br>
                                        <small>{{ __('Public Repos') }}</small>
                                    </h5>
                                </div>
                                <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                    <h5>{{ auth()->user()->followers }}
                                        <br>
                                        <small>{{ __('Followers') }}</small>
                                    </h5>
                                </div>
                                <div class="col-lg-3 mr-auto">
                                    <h5>{{ auth()->user()->public_gist }}
                                        <br>
                                        <small>{{ __('Gist') }}</small>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if(auth()->user()->languages != "")
        @php
            $lang_count = sizeof(unserialize(auth()->user()->languages) );
        $i = 0;
        @endphp
        <script>
            $(document).ready(function () {

                const ctx = document.getElementById('chartEmail').getContext("2d");

                myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: [
                            @foreach(unserialize(auth()->user()->languages) as $lang=>$count)
                                @php
                                    $i++;
                                @endphp
                                '{{$lang}}'
                            @if($i != $lang_count  )
                            ,
                            @endif
                            @endforeach
                        ],
                        datasets: [{
                            label: "Emails",
                            pointRadius: 0,
                            pointHoverRadius: 4,
                            backgroundColor: [
                                '#71cd4a',
                                '#4acccd',
                                '#fcc468',
                                '#ef8157',
                                '#e3e3e3',
                                '#cd4a4a',
                                '#0039ff',
                                '#fff100',
                                '#000000',
                                '#c700ff'
                            ],
                            borderWidth: 0,
                            data: [
                                @foreach(unserialize(auth()->user()->languages) as $lang=>$count)
                                    @php
                                        $i--;
                                    @endphp
                                    '{{$count}}'
                                @if($i != 0 )
                                ,
                                @endif
                                @endforeach
                            ]
                        }]
                    },

                    options: {

                        legend: {
                            display: true,
                            position: 'bottom'
                        },
                        title: {
                            display: true
                        },

                        pieceLabel: {
                            render: 'percentage',
                            fontColor: ['white'],
                            precision: 2
                        },

                        tooltips: {
                            enabled: true
                        },

                        scales: {
                            yAxes: [{

                                ticks: {
                                    display: false
                                },
                                gridLines: {
                                    drawBorder: false,
                                    zeroLineColor: "transparent",
                                    color: 'rgba(255,255,255,0.05)'
                                }

                            }],

                            xAxes: [{
                                barPercentage: 1.6,
                                gridLines: {
                                    drawBorder: false,
                                    color: 'rgba(255,255,255,0.1)',
                                    zeroLineColor: "transparent"
                                },
                                ticks: {
                                    display: false,
                                }
                            }]
                        },
                    }
                });

            });


        </script>
    @endif
@endsection
