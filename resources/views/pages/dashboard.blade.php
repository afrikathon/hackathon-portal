@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'home'
])

@section('content')
    <div class="content">
        <div class="container">
            <!-- Modal -->
            <div class="modal fade" id="badgeModal" tabindex="-1" role="dialog" aria-labelledby="badgeModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="badgeModalLabel">Submit Design Thinking Badge URL</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('badge')}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <img class="img img-fluid" src="{{asset('img/badge.png')}}">
                                <input type="url" name="badge" value="{{old('bade',auth()->user()->badge)}}"
                                       class="form-control" placeholder="Enter Badge URL">
                                @if ($errors->has('badge'))
                                    <span id="name-error" class="error text-danger"
                                          for="input-name">{{ $errors->first('bade') }}</span>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Verify Badge</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="fa fa-github text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        @if(auth()->user()->github == '')
                                            <p class="card-category">Not Connected</p>
                                        @else
                                            <p class="card-category">Connected</p>
                                        @endif
                                        <p class="card-title"><a target="_blank"
                                                                 href="{{auth()->user()->github}}"> {{Str::after(auth()->user()->github, 'github.com/')}}</a>
                                        </p>
                                        <p>
                                        </p></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                @if(auth()->user()->github == '')
                                    <a href="{{route('social.oauth', 'github')}}"> <i class="fa fa-github"></i> Connect
                                        to GitHub</a>
                                @else
                                    <i class="fa fa-check-circle-o"></i> Connected to GitHub
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <img
                                            src="https://images.youracclaim.com/size/340x340/images/854d76bf-4f74-4d51-98a0-d969214bfba7/IBM%2BLogo%2Bfor%2BAcclaim%2BProfile.png">
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Design Thinking</p>
                                        <p class="card-category" style="color: black;font-size: large">
                                            @if(auth()->user()->badge == '')
                                                Not Completed
                                            @else
                                                @if(auth()->user()->badge_verified == 1)
                                                    Verified
                                                @else
                                                    Not Verified
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                @if(auth()->user()->badge == '')
                                    <a href="#" type="button" class="" data-toggle="modal" data-target="#badgeModal"><i
                                            class="fa fa-cloud-upload"></i> Submit Badge</a>
                                @else
                                    @if(auth()->user()->badge_verified == 1)
                                        <i class="fa fa-fa-check-circle-o"></i>  Completed
                                    @else
                                        <a href="#" class="" data-toggle="modal" data-target="#badgeModal"><i
                                                class="fa fa-cloud-upload"></i> Resubmit Badge</a>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="fa fa-users text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Teams</p>
                                        <p class="card-title">No Team
                                        </p>
                                        <p>
                                        </p></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-times"></i> Teams are not open yet
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="fa fa-lightbulb-o text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Submit Idea</p>
                                        <p class="card-category" style="color: black;font-size: large">No Submitted
                                        </p>
                                        <p>
                                        </p></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <a> <i class="fa fa-times"></i> Idea Submission not open yet</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">

                        <div class="card-body">
                            <div class="EarlyAdopterDashboardHeader__Header-sc-3we3hz-1 eKNezB">
                                <h2 class="EarlyAdopterDashboardHeader__Headline-sc-3we3hz-2 gHxNur">Thank you for
                                    signing up! <span role="img" aria-label="">🎉</span></h2>
                                <p class="EarlyAdopterDashboardHeader__Description-sc-3we3hz-3 decjzA">You will
                                    receive instructions via email to verify your account, and how to proceed with
                                    the challenge. While you're at it, please follow us on <a target="_blank"     href="https://twitter.com/afrikathon">Twitter</a>,
                                    <a
                                        href="https://instagram.com/afrikathon__" target="_blank">Instagram</a>, and <a
                                        href="https://facebook.com/afrikathon" target="_blank">Facebook</a>

                                    Invite your Friends, and spread the word about Afrikathon <span role="img"
                                                                                                    aria-label="">🚀</span>
                                    using <strong>Hashtags #OpportunityHackathon #Afrikathon2020</strong>

                                </p>
                                <div class="content">


                                    GETTING STARTED:
                                    <ol>
                                        <li>To be able to create teams, you need to complete the <a
                                                href="https://www.ibm.com/design/thinking/page/courses/Practitioner"
                                                target="_blank">IBM Design Thinking Practitioner Course</a></li>
                                        <li>Team creation will happen live after registration is closed, so you don't
                                            necessarily need to recruit a team mate.
                                        </li>
                                        <li>For more information please check our <a href="https://afrikathon.org/faqs"
                                                                                     target="_blank">FAQS</a> section
                                        </li>
                                        <!-- <li>For more information send an email to <a href="mailto:hello@afrikathon.org">hello@afrikathon.org</a></li> -->

                                    </ol>


                                </div>


                                @if(auth()->user()->badge == "" || auth()->user()->badge_verified == 0 || auth()->user()->badge_verified == "")
                                    <h3>Submit Design Thinking Badge URL</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form action="{{route('badge')}}" method="POST">
                                                @csrf
                                                <div class="modal-body">

                                                    <input type="url" name="badge" required
                                                           class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                           placeholder="Enter Badge URL"
                                                           value="{{old('bade',auth()->user()->badge)}}">
                                                    @if ($errors->has('badge'))
                                                        <span id="name-error" class="error text-danger"
                                                              for="input-name">{{ $errors->first('bade') }}</span>
                                                    @endif
                                                    <button type="submit" class="btn btn-black">Verify Badge
                                                    </button>

                                                </div>

                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <img style="width: 500px" class="img img-fluid"
                                                 src="{{asset('img/badge.png')}}">
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
