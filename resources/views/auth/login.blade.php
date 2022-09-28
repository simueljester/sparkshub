@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-7">
                <div class="card bg-white shadow border-0 pulse">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="row">
                            <div class="col-sm-8 text-center">
                                <strong class="text-muted" style="font-size:20px"> Sparks Hub </strong>
                                <img src="{{ asset('images') }}/na_feb_36.jpg" style="width:100%;" alt="">
                                <small><a href="https://www.freepik.com/free-vector/education-learning-concept-love-reading-people-reading-students-studying-preparing-examination-library-book-lovers-readers-modern-literature-flat-cartoon-vector-illustration_25273862.htm#page=3&query=education%20study%20learning&position=1&from_view=search">Image by jcomp</a> on Freepik</small>
                            </div>
                            <div class="col-sm-4">
                                <center>
                                    <a href="/"> <img src="{{ asset('images') }}/274476676_4675508945893908_2973338567599810336_n.png" width="50" alt=""></a>
                                    <br>
                                    <strong class="text-primary"> Login </strong>
                                </center>
                                <hr>
                                <form role="form" method="POST" action="{{ route('login') }}">
                                @csrf
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" value="admin@argon.com" required autofocus>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" value="" required>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customCheckLogin">
                                            <span class="text-muted">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary my-4">{{ __('Sign in') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                
                    </div>
                </div>
                {{-- <div class="row mt-3">
                    <div class="col-6">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-light">
                                <small>{{ __('Forgot password?') }}</small>
                            </a>
                        @endif
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('register') }}" class="text-light">
                            <small>{{ __('Create new account') }}</small>
                        </a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
