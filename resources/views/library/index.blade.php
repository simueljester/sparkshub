@extends('layouts.app')

@section('content')

 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"> Library </li>
        </ol>
    </nav>
           
    <center>
        <i class="fas fa-university fa-5x"></i>
        <br>
        <span class="text-primary" style="font-size: 22px; font-weight:bold"> PAROLA </span>
        <br>
        <span class="text-muted text-capitalize"> Web-Based Library Management System of Boot National High School </span>
    </center>
    <br>
      <br>
    <div class="row">
        <div class="col-sm-6 text-center">
            <div class="library slideInLeft">
                <img class="library-profile-img" src="{{ asset('images') }}/paul-melki-bByhWydZLW0-unsplash.jpg" alt="">
                <div class="library-description-bk bg-gradient-info"></div>
                <div class="library-description">
                    <strong style="font-size:20px;"> Books Section </strong>
                    <p> Borrowing books made easy in SPARKS HUB. </p>
                </div>
                <br>
                <div class="library-btn border-custom">
                    <a href="{{route('library.books')}}"> Start Browsing </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 text-center">
            <div class="second library slideInRight">
                <img class="library-profile-img" src="https://images.pexels.com/photos/159497/school-notebook-binders-notepad-159497.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
                <div class="library-description-bk" style="background: rgb(214,210,78);
background: linear-gradient(277deg, rgba(214,210,78,0.9220063025210083) 19%, rgba(254,247,34,0.9220063025210083) 35%);"></div>
                <div class="library-description text-muted">
                    <strong style="font-size:20px;"> Modules Section </strong>
                    <p> Browse modules uploaded by our own teachers! </p>
                </div>
                <br>
                <div class="library-btn border-custom">
                    <a href="{{route('library.modules')}}"> Start Browsing </a>
                </div>
            </div>
        </div>
    </div>
        



            
     
    <script>
  

        
    </script>
@endsection

