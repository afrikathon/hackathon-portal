@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'submit'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">
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
                                                    <a class="nav-link" href="#invite" data-toggle="tab">Invite
                                                        Teammates
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
                                                <form action="{{route('team.update',['team'=>$team])}}" method="POST">
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
                                                    <strong> "{{Str::lower( 'team-'.$team->code)}}"</strong></p>
                                                <p> Team's github Repositories : <a href="{{$team->github}}"
                                                                                    target="_blank"> {{$team->github}}</a>
                                                </p>

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
                                                                            src="{{$member->avatar}}"
                                                                            class="img-raised">
                                                                    </div>
                                                                </td>
                                                                <td class="text-left">
                                                                    <h5 class="mb-0">{{$member->name}}</h5>
                                                                    <p>{{$member->bio}}</p>
                                                                    <p><small>{{$member->skills}} </small></p>
                                                                </td>
                                                                <td class="td-actions text-right">
                                                                    @if($member->id == $team->lead_id)
                                                                        <p>(Team Lead)</p>
                                                                    @elseif($team->lead_id == auth()->id())
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
                                                    @foreach(\App\User::where('id','<>',auth()->id())->get()  as $user)
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
                                                                <p>{{$user->bio}}</p>
                                                                <p><small><strong> Skills:</strong> {{$user->skills}}
                                                                    </small></p>
                                                            </td>
                                                            @if( \App\TeamMember::where('user_id',auth()->id())->count() >= 1 )
                                                                <td class="td-actions text-right">
                                                                    @if(\App\Invite::where('team_id',$team->id)->where('email',$user->email)->count() >= 1)
                                                                        <a type="button" id="{{$user->email}}"
                                                                           rel="tooltip"
                                                                           title="Invite"
                                                                           class="btn btn-link text-dark"
                                                                           data-original-title="Invite">
                                                                            <i class="fa fa-check"></i>Invitation Sent
                                                                        </a>
                                                                    @else
                                                                        <a type="button" id="{{$user->email}}"
                                                                           rel="tooltip"
                                                                           title="Invite"
                                                                           class="btn btn-link text-primary inviteUser"
                                                                           href="#"
                                                                           data-original-title="Invite">

                                                                        <span class="in"> <i
                                                                                class="nc-icon nc-simple-add"></i> Invite
                                                                        </span>
                                                                            <span class="load" style="display: none"> <i
                                                                                    class="fa fa-spinner fa-spin"></i> Sending Invite
                                                                        </span>
                                                                            <span class="sent" style="display: none"><i
                                                                                    class="fa fa-check"></i>Invitation Sent
                                                                        </span>
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                            @endif
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
                                                          {{--  <td class="img-row">
                                                                <div class="img-wrapper">
                                                                    <img
                                                                        src="https://paper-dashboard-pro-laravel.creative-tim.com/img/faces/ayo-ogunseinde-2.jpg"
                                                                        class="img-raised">
                                                                </div>
                                                            </td>--}}
                                                            <td class="text-left">
                                                                <h5 class="mb-0">{{$team->name}}</h5>
                                                                <p>{{$team->description}}</p>
                                                            </td>
                                                            @if( \App\TeamMember::where('user_id',auth()->id())->count() < 1 )
                                                              <td class="td-actions text-right">
                                                                  <button type="button" rel="tooltip" title=""
                                                                          class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                                                          data-original-title="Remove">
                                                                      <i class="nc-icon nc-simple-remove"></i>
                                                                  </button>
                                                              </td>
                                                            @endif
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
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header">
                        <h5>Invites and requests </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                @foreach(\App\Invite::where('email',auth()->user()->email)->where('status','Pending')->get() as $invite)
                                    <tr>
                                        <td class="img-row">
                                            <a href="{{route('team.invite.show',['team'=>$invite->team,'invite'=>$invite])}}">
                                                <div class="img-wrapper">
                                                    <img
                                                        src="{{$invite->user->avatar}}"
                                                        class="img-raised">
                                                </div>
                                            </a>
                                        </td>
                                        <td class="text-left">
                                            <a href="{{route('team.invite.show',['team'=>$invite->team,'invite'=>$invite])}}">
                                                <p>{{$invite->user->name}} invited you to join
                                                    team {{$invite->team->name}}</p>

                                            </a>
                                        </td>
                                        <td class="td-actions text-right">
                                            <a href="{{route('team.invite.show',['team'=>$invite->team,'invite'=>$invite])}}">
                                                <small>View Invite</small>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                                @foreach(\App\Invite::where('user_id',auth()->id())->where('status','<>','Accepted')->get() as $invite)
                                    @php
                                        $new_user = \App\User::where('email',$invite->email)->first();
                                    @endphp
                                    @if($new_user)
                                        <tr>
                                            <td class="text-left">
                                                <p>You invited {{$new_user->name}} to join {{$invite->team->name}}</p>
                                                <p><small>{{$invite->status}}</small></p>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-left">
                                                <p>You invited {{$invite->email}} to join {{$invite->team->name}}</p>
                                                <p><small>{{$invite->status}}</small></p>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        jQuery(document).ready(function () {
            jQuery('.inviteUser').click(function (e) {
                e.preventDefault();
                const btn = $(this)
                btn.find(".in").hide()
                btn.find(".sent").hide()
                btn.find(".load").show()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ route('team.invite',['team'=>$team]) }}",
                    method: 'post',
                    data: {
                        email: this.id,
                        message: "Hey, I am interested in having you in my team.",
                    },
                    success: function (result) {
                        btn.find(".in").hide()
                        btn.find(".load").hide()
                        btn.find(".sent").show()
                        btn.removeClass('inviteUser')
                    }
                });
            });
        });
    </script>
@endsection
