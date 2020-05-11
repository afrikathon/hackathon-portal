@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'submit'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="container">
                <div class="card ">

                    <div class="card-body">
                        <p>  {{$invite->user->name}} wants you to be part of team {{$invite->team->name}}.
                            <br>Please accept the request if you would like to be part of
                            team {{$invite->team->name}}.<br></p>
                        <a class="btn btn-primary">Accept</a>
                        <a class="btn btn-danger">Decline</a>
                           <h4>Team Name: {{ $team->name}}</h4>
                           <p>{{$team->description}}</p>
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
                                                    src="{{$member->avatar}}"
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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
