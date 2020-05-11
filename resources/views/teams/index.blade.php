@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'submit'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-9">
                <div class="card ">

                    <div class="card-body">
                        <div class="card card-nav-tabs card-plain">
                            <div class="card-header card-header-danger">
                                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#create" data-toggle="tab">
                                                    @if( \App\TeamMember::where('user_id',auth()->id())->count() >= 1 )
                                                        Your Team  @else Create Team @endif </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#users" data-toggle="tab">Browse All
                                                    Participates</a>
                                            </li>
                                            @if( \App\TeamMember::where('user_id',auth()->id())->count() >= 1 )
                                            <li class="nav-item">
                                                <a class="nav-link" href="#invite" data-toggle="tab">Invite Teammates
                                                    Email ID</a>
                                            </li>
                                            @endif
                                            <li class="nav-item">
                                                <a class="nav-link" href="#teams" data-toggle="tab">Browse Teams</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body ">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="create">
                                        <div class="container">
                                            @if( \App\TeamMember::where('user_id',auth()->id())->count() >= 1 )
                                                @php
                                                    $team = \App\TeamMember::where('user_id',auth()->id())->first();
                                                $team = \App\Team::find($team->team_id)
                                                @endphp
                                                <form action="{{route('team.store')}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div
                                                                class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                                <input
                                                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                    name="name" id="input-name" type="text"
                                                                    placeholder="{{ __('Team Name') }}"
                                                                    value="{{ old('name', $team->name) }}"
                                                                    required="true"
                                                                    aria-required="true"/>
                                                                @if ($errors->has('name'))
                                                                    <span id="name-error" class="error text-danger"
                                                                          for="input-name">{{ $errors->first('name') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div
                                                                class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                                        <textarea
                                                            class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                            name="description"
                                                            placeholder="{{ __('Team Description ') }}"
                                                            required="true"
                                                            aria-required="true">{{ old('description', $team->description) }}</textarea>
                                                                @if ($errors->has('description'))
                                                                    <span id="name-error" class="error text-danger"
                                                                          for="input-name">{{ $errors->first('description') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($team->lead_id  === auth()->id())
                                                        <div class="card-footer ml-auto mr-auto">
                                                            <button type="submit"
                                                                    class="btn btn-primary">{{ __('Save') }}</button>
                                                        </div>
                                                    @endif
                                                </form>
                                                <p> Join you team chanel in the afrikation workspace:
                                                    <strong>  "{{Str::lower( 'team-'.Str::slug($team->name))}}"</strong></p>
                                                <p> Team's github  Repositories : <a href="{{$team->github}}" target="_blank"> {{$team->github}}</a></p>

                                                <hr>
                                                <h4>Teammates</h4>
                                                <div class="table-full-width">
                                                    <table class="table">
                                                        <tbody>
                                                        @foreach($team->members as $member)

                                                        <tr>
                                                            <td class="img-row">
                                                                <div class="img-wrapper">
                                                                    <img
                                                                        src="https://paper-dashboard-pro-laravel.creative-tim.com/img/faces/ayo-ogunseinde-2.jpg"
                                                                        class="img-raised">
                                                                </div>
                                                            </td>
                                                            <td class="text-left">
                                                                <h5 class="mb-0">{{$member->name}}</h5>
                                                                <p>{{$member->job_role}}</p>
                                                                <p><small>{{$member->skills}} </small></p>
                                                            </td>
                                                            <td class="td-actions text-right">
                                                                @if($member->id == $team->lead_id)
                                                                    <p>(Team Lead)</p>
                                                                @else
                                                                <button type="button" rel="tooltip" title=""
                                                                        class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                                                        data-original-title="Remove">
                                                                    <i class="nc-icon nc-simple-remove"></i>
                                                                </button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <h4>Create your Team</h4>
                                                <form action="{{route('team.store')}}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div
                                                                class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                                <input
                                                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                    name="name" id="input-name" type="text"
                                                                    placeholder="{{ __('Team Name') }}"
                                                                    value="{{ old('name', auth()->user()->name) }}"
                                                                    required="true"
                                                                    aria-required="true"/>
                                                                @if ($errors->has('name'))
                                                                    <span id="name-error" class="error text-danger"
                                                                          for="input-name">{{ $errors->first('name') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div
                                                                class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                                        <textarea
                                                            class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                            name="description"
                                                            placeholder="{{ __('Team Description ') }}"
                                                            required="true"
                                                            aria-required="true"></textarea>
                                                                @if ($errors->has('name'))
                                                                    <span id="name-error" class="error text-danger"
                                                                          for="input-name">{{ $errors->first('description') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer ml-auto mr-auto">
                                                        <button type="submit"
                                                                class="btn btn-primary">{{ __('Save') }}</button>
                                                    </div>
                                                </form>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="users">
                                        <div class="container">
                                            <h4>Participants</h4>
                                            <div class="table-full-width">
                                                <table class="table">
                                                    <tbody>
                                                    @foreach(\App\User::all()  as $user)
                                                        <tr>
                                                            <td class="img-row">
                                                                <div class="img-wrapper">
                                                                    <img
                                                                        src="{{$user->avatar}}"
                                                                        class="img-raised">
                                                                </div>
                                                            </td>
                                                            <td class="text-left">
                                                                <h5 class="mb-0">{{$user->name}}</h5>
                                                                <p>{{$user->job_role}}</p>
                                                                <p><small><strong> Skills:</strong> {{$user->skills}}
                                                                    </small></p>
                                                            </td>
                                                            <td class="td-actions text-right">
                                                                <a type="button" rel="tooltip" title="Invite"
                                                                   class="btn btn-link text-primary"
                                                                   href="#"
                                                                   data-original-title="Invite">
                                                                    <i class="nc-icon nc-simple-add"></i> Invite
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @if( \App\TeamMember::where('user_id',auth()->id())->count() >= 1 )
                                        @php
                                            $team = \App\TeamMember::where('user_id',auth()->id())->first();
                                        $team = \App\Team::find($team->team_id)
                                        @endphp
                                    <div class="tab-pane" id="invite">
                                        <div class="container">
                                            <h4>Invite Teammates by email</h4>
                                            <form action="{{route('team.invite',['team'=>$team])}}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div
                                                            class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                                            <input
                                                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                                name="email" id="input-name" type="email"
                                                                placeholder="{{ __('Enter Email') }}"
                                                                value="{{ old('email') }}"
                                                                required="true"
                                                                aria-required="true"/>
                                                            @if ($errors->has('email'))
                                                                <span id="name-error" class="error text-danger"
                                                                      for="input-name">{{ $errors->first('email') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div
                                                            class="form-group{{ $errors->has('message') ? ' has-danger' : '' }}">
                                                            <label>Add a personal message</label>
                                                            <textarea
                                                                class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}"
                                                                name="message"
                                                                placeholder="{{ __('Add a personal message') }}"
                                                                required="true"
                                                                aria-required="true">Hey, I am interested in having you in my team.</textarea>
                                                            @if ($errors->has('message'))
                                                                <span id="name-error" class="error text-danger"
                                                                      for="input-name">{{ $errors->first('message') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer ml-auto mr-auto">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{ __('Send Invite') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="tab-pane" id="teams">
                                        <div class="container">
                                            <div class="table-full-width">
                                                <table class="table">
                                                    <tbody>
                                                    @forelse(\App\Team::all() as $team)
                                                        <tr>
                                                            <td class="img-row">
                                                                <div class="img-wrapper">
                                                                    <img
                                                                        src="https://paper-dashboard-pro-laravel.creative-tim.com/img/faces/ayo-ogunseinde-2.jpg"
                                                                        class="img-raised">
                                                                </div>
                                                            </td>
                                                            <td class="text-left">
                                                                <h5 class="mb-0">{{$team->name}}</h5>
                                                                <p>{{$team->description}}</p>
                                                            </td>
                                                            <td class="td-actions text-right">
                                                                <button type="button" rel="tooltip" title=""
                                                                        class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                                                        data-original-title="Remove">
                                                                    <i class="nc-icon nc-simple-remove"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-left">
                                                                <h5 class="mb-0">No team has been created yet.</h5>
                                                                <a href="{{route('teams')}}" class="btn btn-primary">Create
                                                                    a Team Now</a>

                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card ">

                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
