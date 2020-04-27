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
                <div class="card">
                    <h6 class="card-header card-header-info">
                        <span class="pull-left"> Profile Completeness </span>
                        <span> <a href="{{route('profile.edit')}}" style="margin: 0" class="pull-right btn btn-black"><i
                                    class="fa fa-edit"></i> Edit Profile</a></span>
                    </h6>
                    <div class="card-body">
                        <div class="progress-container progress-info">
                            <div class="progress">
                                <div class="progress-bar progress-bar-info" role="progressbar"
                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 60%; background-color: black">
                                    <span class="progress-value">60%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">


                        <h4 class="card-title">{{ __('Technical Skills') }}
                            <span> <a href="{{ route('social.oauth', 'github') }}"
                                      class="pull-right btn btn-github btn-sm" style="margin: 0; font-size: small ">
                                    <i class="fa fa-github" style="font-size: large "></i> Update with Github
                                    </a></span>
                            <span> <a href="{{route('profile.edit')}}" style="margin: 0 5px 0 0;font-size: small"
                                      class="pull-right btn btn-black btn-sm"><i style="font-size: large "
                                                                                 class="fa fa-edit"></i> Edit Profile</a></span>



                        </h4>
                        <p> {{auth()->user()->skills}}</p>
                        <br>
                        <h4 class="card-title">{{ __('Language Activity') }} <img src="{{asset('img/github.png')}}"
                                                                                  style="width: 100px"></h4>
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
    @if(auth()->user()->languages != "" )
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
