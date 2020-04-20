@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'submit'
])

@section('content')
    <div class="content">

        <div class="row">
            <div class="col-md-3">
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
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Password</label>
                                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Address 2</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">City</label>
                                    <input type="text" class="form-control" id="inputCity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">State</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputZip">Zip</label>
                                    <input type="text" class="form-control" id="inputZip">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="">
                                        Check me out
                                        <span class="form-check-sign">
            <span class="check"></span>
          </span>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign in</button>
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
