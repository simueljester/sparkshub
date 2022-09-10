<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> Online Library System </title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        
        <style>
            .border-custom{
                border-radius: 14px;
            }
            .book-library {
                 transform: scale(0.9); 
                transition: transform .2s;
                margin: 0 auto;
            }

            .book-library:hover {
                -ms-transform: scale(1.5); /* IE 9 */
                -webkit-transform: scale(1.5); /* Safari 3-8 */
                transform: scale(1.0); 
                color: rgb(227, 123, 53);
                cursor:pointer;
            }
        </style>
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth
        

        <div class="main-content">
            <div class="card m-2 shadow bg-gradient-warning text-right text-white">
                <div class="card-body">
                    @auth
                        <ul class="nav nav-pills nav-pills-circle float-right" id="tabs_2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link rounded-circle" id="home-tab" onclick="openNotification()" href="#" role="tab" aria-controls="home" aria-selected="true">
                                    <span class="nav-link-icon d-block"><i class="fas fa-bell"></i> 
                                        @if ($notifications->count() != 0)
                                            <strong class="text-danger"> {{$notifications->count()}} </strong> 
                                        @endif 
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" href="#tabs_2_2" role="tab" aria-controls="profile" aria-selected="false">
                                    <span class="nav-link-icon d-block"><i class="fas fa-user"></i> <strong class="text-danger"> </strong></span>
                                </a>
                            </li>
                            <li class="nav-item">
                               
                                <a class="nav-link" id="contact-tab" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <span class="nav-link-icon d-block"><i class="fas fa-sign-out-alt"></i></span>
                                </a>
                            </li>
                        </ul>
                     @endauth
                    @guest
                        <a href="/" class="text-white"> <i class="fas fa-home"></i> <span> Home </span>  </a>
                        <a class="text-white ml-3" href="{{ route('login') }}">
                            <i class="ni ni-key-25"></i>
                            <span class="nav-link-inner--text">{{ __('Login') }}</span>
                        </a>
                    @endguest
                </div>
            </div>
            <div class="p-2">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-text"><strong>Success!</strong> {{ session()->get('success') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> <strong>Notice!</strong>  {{session()->get('error') }}
                    </div>
                 @endif
                  @if ($errors->any())
                    @foreach ($errors->all() as $error)
                         <div class="alert alert-danger" role="alert">{{$error}}</div>
                    @endforeach
                @endif
                <div>
                    @yield('content')
                </div>
            </div>
        </div>

        <div class="modal fade" id="notification-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-white">
                        <h5 class="modal-title" id="exampleModalLabel"> Notification </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @forelse ($notifications as $notification)
                            <a href="{{route('notification.read',$notification)}}">
                                <div class="card shadow mt-2 border-custom">
                                    <div class="card-body">
                                        <span class="{{$notification->read_at ? 'text-muted' : 'text-primary'}}">
                                            <i class="fas fa-user"></i> {{$notification->notifiedBy->name}} {{$notification->description}}
                                        </span>
                                    </div>
                                </div>                                
                            </a>
                        @empty
                            No unread notification
                        @endforelse   
                    </div>
                    <div class="modal-footer bg-gradient-warning">
                        <a href="#" class="text-white"> <strong> All notification </strong> </a>
                    </div>
                </div>
            </div>
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
        <script>
            function openNotification(){
                $('#notification-modal').modal('show'); 
            }
        </script>
    </body>
</html>