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
        <span class="text-warning" style="font-size: 22px; font-weight:bold"> Sparks Hub </span>
        <br>
        <span class="text-muted text-capitalize"> Web-Based Library Management System of Balele Integrated High School </span>
    </center>
    <br>
      <br>
    <div class="row">
        <div class="col-sm-6 text-center">
            <div class="library slideInLeft">
                <img class="library-profile-img" src="https://images.pexels.com/photos/9572390/pexels-photo-9572390.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
                <div class="library-description-bk bg-gradient-primary"></div>
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
                <div class="library-description-bk bg-gradient-warning"></div>
                <div class="library-description">
                    <strong style="font-size:20px;"> Modules Section </strong>
                    <p> Browse modules uploaded by our own teachers! </p>
                </div>
                <br>
                <div class="library-btn border-custom">
                    <a href="#"> Start Browsing </a>
                </div>
            </div>
        </div>
    </div>
        



            
     
    <script>
  

        
    </script>
@endsection

