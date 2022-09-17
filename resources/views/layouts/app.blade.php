<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Balele IHS - Tanauan City Spark Hub</title>
        <!-- Favicon -->
        <link rel="icon" href="{{ asset('images') }}/274476676_4675508945893908_2973338567599810336_n.png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
             
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

            .library {
                display: inline-block;
                position: relative;
                width: 90%;
                min-width: 400px;
                height: 400px;
                border-radius: 30px;
                overflow:hidden;
                box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.3);
                margin: 30px;
            }

            .library-profile-img {
                height: 80%;
            }

            .library-description-bk {
                /* background-image: linear-gradient(0deg , #5872e7, #f86d68); */
                border-radius: 30px;
                position: absolute;
                top: 55%;
                left: -5px;
                height: 55%;
                width: 108%;
                transform: skew(19deg, -9deg);
            }

            .second .library-description-bk {
                /* background-image: linear-gradient(-20deg , #bb7413, #e7d25c) */
            }

            .library-logo {
                height: 80px;
                width: 80px;
                border-radius: 20px;
                background-color: #fff;
                position: absolute;
                bottom: 30%;
                left: 30px;
                overflow:hidden;
                box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.7);
            }

            .library-logo img {
                height: 100%;
            }

            .library-description {
                position: absolute;
                color: #fff;
                font-weight: 900;
                left: 180px;
                bottom: 15%;
            }

            .library-btn {
                position: absolute;
                color: #fff;
                right: 30px;
                bottom: 4%;
                padding: 10px 20px;
                border: 1px solid #fff;
            }

            .library-btn a {
                color: #fff;
            }
            /* END CARD DESIGN */


            .slideInRight {
                -webkit-animation-name: slideInRight;
                animation-name: slideInRight;
                -webkit-animation-duration: 1s;
                animation-duration: 1s;
                -webkit-animation-fill-mode: both;
                animation-fill-mode: both;
                }
                @-webkit-keyframes slideInRight {
                0% {
                -webkit-transform: translateX(100%);
                transform: translateX(100%);
                visibility: visible;
                }
                100% {
                -webkit-transform: translateX(0);
                transform: translateX(0);
                }
                }
                @keyframes slideInRight {
                0% {
                -webkit-transform: translateX(100%);
                transform: translateX(100%);
                visibility: visible;
                }
                100% {
                -webkit-transform: translateX(0);
                transform: translateX(0);
                }
            } 

            .slideInLeft {
                -webkit-animation-name: slideInLeft;
                animation-name: slideInLeft;
                -webkit-animation-duration: 1s;
                animation-duration: 1s;
                -webkit-animation-fill-mode: both;
                animation-fill-mode: both;
                }
                @-webkit-keyframes slideInLeft {
                0% {
                -webkit-transform: translateX(-100%);
                transform: translateX(-100%);
                visibility: visible;
                }
                100% {
                -webkit-transform: translateX(0);
                transform: translateX(0);
                }
                }
                @keyframes slideInLeft {
                0% {
                -webkit-transform: translateX(-100%);
                transform: translateX(-100%);
                visibility: visible;
                }
                100% {
                -webkit-transform: translateX(0);
                transform: translateX(0);
                }
            } 

            .pulse {
                -webkit-animation-name: pulse;
                animation-name: pulse;
                -webkit-animation-duration: 1s;
                animation-duration: 1s;
                -webkit-animation-fill-mode: both;
                animation-fill-mode: both;
                }
                @-webkit-keyframes pulse {
                0% {
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
                }
                50% {
                -webkit-transform: scale3d(1.05, 1.05, 1.05);
                transform: scale3d(1.05, 1.05, 1.05);
                }
                100% {
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
                }
                }
                @keyframes pulse {
                0% {
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
                }
                50% {
                -webkit-transform: scale3d(1.05, 1.05, 1.05);
                transform: scale3d(1.05, 1.05, 1.05);
                }
                100% {
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
                }
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
                                <a class="nav-link" id="profile-tab" href="{{route('users.profile',Auth::user())}}" role="tab" aria-controls="profile" aria-selected="false">
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
                        <a href="/" class="text-white"> <i class="fas fa-home"></i> <span> Homepage </span>  </a>
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
                                            <img id="output" style="border-radius: 50%;" width="45" height="45" src="{{ $notification->notifiedBy->avatar ? '/images/'.$notification->notifiedBy->avatar : Avatar::create($notification->notifiedBy->name)->toBase64() }}" /> {{$notification->notifiedBy->name}} {{$notification->description}}
                                        </span>
                                    </div>
                                </div>                                
                            </a>
                        @empty
                            No unread notification
                        @endforelse   
                    </div>
                    <div class="modal-footer bg-gradient-warning">
                        <a href="{{route('notification.index')}}" class="text-white"> <strong> All notification </strong> </a>
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
        <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
        
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