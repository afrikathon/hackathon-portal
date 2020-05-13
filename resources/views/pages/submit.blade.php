@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'submit'
])

@section('content')
    <div class="content">
        @if (session('status'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-primary">
                        <button type="button" class="close" data-dismiss="alert"
                                aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                        <span>{{ session('status') }}</span>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-3">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('img/logo_l.jpg') }}" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">

                            {{--<img class="avatar border-gray" src="{{ auth()->user()->avatar}}" alt="...">--}}
                            <div class=" avatar avatar-circle"
                                 style="background-color: <?php printf("#%06X\n", mt_rand(0, 0x222222)); ?>">
                                <span class="initials">{{Str::substr($team->name, 0, 1)}}</span>
                            </div>
                            <h5 class="title mb-0">Team {{ __($team->name)}}</h5>

                            <p class="description mb-0">
                                {{ __($team->description)}}
                            </p>

                            <div class="social">
                                <a href="{{ $team->github }}" target="_blank"
                                   class="btn btn-icon btn-round btn-gtihub">
                                    <i class="fa fa-github"></i>
                                </a>

                            </div>
                        </div>
                        <p class="description text-center">

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h4>Your Team Submissions</h4>
                        <form action="{{route('submit.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">title</label>
                                    <input type="text" value="{{ old('name',$team->submission->title) }}" required
                                           name="title" class="form-control" placeholder="Project Title">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Description</label>
                                    <textarea type="text" required name="description" class="form-control"
                                              placeholder="Project Description">{{ old('name',$team->submission->description) }}</textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Description</label>
                                    <textarea type="text" name="problem" class="form-control"
                                              placeholder="Problem Statement">{{ old('name',$team->submission->problem) }}</textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Description</label>
                                    <textarea type="text" name="solution" class="form-control"
                                              placeholder="solution Statement">{{ old('name',$team->submission->solution) }}</textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <p>You can continue updating your submission till this phase is over.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')

@endsection
@section('style')
    <style>
        .avatar-circle {
            width: 50px;
            height: 50px;
            text-align: center;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            margin-left: 23%;
        }

        .initials {
            position: relative;
            top: 60px; /* 25% of parent */
            font-size: 100px; /* 50% of parent */
            line-height: 50px; /* 50% of parent */
            color: #fff;
            font-family: "Courier New", monospace;
            font-weight: bold;
        }
    </style>
@endsection
