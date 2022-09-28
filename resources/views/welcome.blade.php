{{-- @extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-white">Homepage</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>

    <div class="container mt--10 pb-5"></div>
@endsection --}}


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>Balele IHS - Tanauan City</title>
    <link rel="icon" href="{{ asset('images') }}/274476676_4675508945893908_2973338567599810336_n.png">
  
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('web') }}/css/fontawesome.css">
    <link rel="stylesheet" href="{{ asset('web') }}/css/templatemo-grad-school.css">
    <link rel="stylesheet" href="{{ asset('web') }}/css/owl.css">
    <link rel="stylesheet" href="{{ asset('web') }}/css/lightbox.css">
<!--
    
TemplateMo 557 Grad School

https://templatemo.com/tm-557-grad-school

-->
  </head>

<body>

   
  <!--header-->
  <header class="main-header clearfix" role="header">
    <div class="logo">
      <a href="/"> <img src="{{ asset('images') }}/274476676_4675508945893908_2973338567599810336_n.png" width="50" alt=""> <em>BALELE</em> IHS</a>
    </div>
    <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
    <nav id="menu" class="main-nav" role="navigation">
      <ul class="main-menu">
        <li><a href="/">Home</a></li>
        <li class="has-submenu"><a href="#section2">About Us</a>
          <ul class="sub-menu">
            <li><a href="#mission-vision">Mission</a></li>
            <li><a href="#mission-vision">Vision</a></li>
          </ul>
        </li>
        <li><a href="#section5">Sparks Hub</a></li>
        <li><a href="/login" class="external">Login</a></li>
      </ul>
    </nav>
  </header>

  <!-- ***** Main Banner Area Start ***** -->
  <section class="section main-banner" id="top" data-section="section1">
      <video autoplay muted loop id="bg-video">
          <source src="{{ asset('web') }}/images/course-video.mp4" type="video/mp4" />
      </video>

      <div class="video-overlay header-text">
          <div class="caption">
             <a href="/"> <img src="{{ asset('images') }}/274476676_4675508945893908_2973338567599810336_n.png" width="100" alt=""></a>
             <br> 
             <h6 class="mt-1">Tanauan City</h6>
              <h2><em>BALELE</em> Integrated High School </h2>
         
          </div>
      </div>
  </section>
  <!-- ***** Main Banner Area End ***** -->


  <section class="features" data-section="mission-vision">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-12">
          <div class="features-post">
            <div class="features-content">
              <div class="content-show">
                <h4><i class="fa fa-pencil"></i> About Balele </h4>
              </div>
              <div class="content-hide">
                <p>SPARKS HUB (Seamless, Progressive, Academic-Research Knowledge Hub), the first of its kind in the public school systems aims to provides services that promote the pursuit of knowledge and intellectual activity; to provide various bibliographies and library pathfinders for simple access and retrieval of information. Moreover SPARKSHUB foster an environment in which students and educators may enjoy the learning experience through accessible and relevant academic resources.</p>
                <p class="hidden-sm">Curabitur id eros vehicula, tincidunt libero eu, lobortis mi. In mollis eros a posuere imperdiet.</p>
            </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="features-post second-features">
            <div class="features-content">
              <div class="content-show">
                <h4><i class="fa fa-graduation-cap"></i>Mission</h4>
              </div>
              <div class="content-hide">
                <p>Transforming Communities Through Literacy</p>
                <p class="hidden-sm">Curabitur id eros vehicula, tincidunt libero eu, lobortis mi. In mollis eros a posuere imperdiet.</p>
            </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="features-post third-features">
            <div class="features-content">
              <div class="content-show">
                <h4><i class="fa fa-book"></i>Vision</h4>
              </div>
              <div class="content-hide">
                <p>Luceat Lux Vestra</p>
                <p class="hidden-sm">Curabitur id eros vehicula, tincidunt libero eu, lobortis mi. In mollis eros a posuere imperdiet.</p>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section why-us" data-section="section2">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Balele IHS</h2>
          </div>
        </div>
        <div class="col-md-12">
          <div id='tabs'>
            <ul>
              <li><a href='#tabs-1'>Best Education</a></li>
              <li><a href='#tabs-2'>Top Management</a></li>
              <li><a href='#tabs-3'>Quality Meeting</a></li>
            </ul>
            <section class='tabs-content'>
              <article id='tabs-1'>
                <div class="row">
                  <div class="col-md-6">
                    <img src="{{ asset('images') }}/304184621_5456800597740261_6517738824375084705_n.jpg" alt="">
                  </div>
                  <div class="col-md-6">
                    <h4>Best Education</h4>
                    <p>Grad School is free educational HTML template with Bootstrap 4.5.2 CSS layout. Feel free to use it for educational or commercial purposes. You may want to make <a href="https://paypal.me/templatemo" target="_parent" rel="sponsored">a little donation</a> to TemplateMo. Please tell your friends about us. Thank you.</p>
                  </div>
                </div>
              </article>
              <article id='tabs-2'>
                <div class="row">
                  <div class="col-md-6">
                    <img src="{{ asset('images') }}/305110480_436520905210789_7379937744488947692_n.jpg" alt="">
                  </div>
                  <div class="col-md-6">
                    <h4>Top Level</h4>
                    <p>You can modify this HTML layout by editing contents and adding more pages as you needed. Since this template has options to add dropdown menus, you can put many HTML pages.</p> 
                    <p>Suspendisse tincidunt, magna ut finibus rutrum, libero dolor euismod odio, nec interdum quam felis non ante.</p>
                  </div>
                </div>
              </article>
              <article id='tabs-3'>
                <div class="row">
                  <div class="col-md-6">
                    <img src="{{ asset('images') }}/305314211_1110023376582885_2087890433687680812_n.jpg" alt="">
                  </div>
                  <div class="col-md-6">
                    <h4>Quality Meeting</h4>
                    <p>You are NOT allowed to redistribute this template ZIP file on any template collection website. However, you can use this template to convert into a specific theme for any kind of CMS platform such as WordPress. For more information, you shall <a rel="nofollow" href="https://templatemo.com/contact" target="_parent">contact TemplateMo</a> now.</p>
                  </div>
                </div>
              </article>
            </section>
          </div>
        </div>
      </div>
    </div>
  </section>

    <section class="section video" data-section="section5">
        <div class="container">
        <div class="row">
            <div class="col-md-6 align-self-center">
            <div class="left-content">
                <span> School innovation </span>
                <h4> Our new online library platform <em> SPARKS HUB </em></h4>
                <p>Sparks hub is a virtual library for Balele IHS students. Books and Modules management console provides easy access for borrowing, tracking and monitoring of borrowed books inside the library of Balele IHS.
                <br><br>It also aims to provide our teachers and librarians to easily upload contents accessible by students </p>
                <div class="main-button"><a rel="nofollow" href="/login" target="_parent">Start your experience</a></div>
            </div>
            </div>
            <div class="col-md-6">
            <article class="video-item">
                <a href="/login"><img class="ml-5" src="{{ asset('images') }}/299597394_465472012256219_7350261229131616474_n.jpg" width="400"></a>
            </article>
            </div>
        </div>
        </div>
    </section>

  <section class="section courses" data-section="section4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>SPARKS HUB, its conception to execution. </h2>
          </div>
        </div>
        <div class="owl-carousel owl-theme">
          <div class="item">
            <img src="{{ asset('images') }}/299597394_465472012256219_7350261229131616474_n.jpg" alt="Course #1">
            <div class="down-content">
              <h4>SPARKS HUB</h4>
              <p>You can get free images and videos for your websites by visiting Unsplash, Pixabay, and Pexels.</p>
         
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('images') }}/299683400_465472115589542_1404411560205968186_n.jpg" alt="Course #2">
            <div class="down-content">
              <h4>THE HEART OF INNOVATION</h4>
              <p>Quisque cursus augue ut velit dictum, quis volutpat enim blandit. Maecenas a lectus ac ipsum porta.</p>
          
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('images') }}/299684031_465472058922881_1767289535148568264_n.jpg" alt="Course #3">
            <div class="down-content">
              <h4>THE COFFEE CONNECT BAR</h4>
              <p>Pellentesque ultricies diam magna, auctor cursus lectus pretium nec. Maecenas finibus lobortis enim.</p>
         
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('images') }}/299699339_465472122256208_8446490197902200109_n.jpg" alt="Course #4">
            <div class="down-content">
              <h4>STUDENT CENTERED</h4>
              <p>Download free images and videos for your websites by visiting Unsplash, Pixabay, and Pexels.</p>
            
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('images') }}/299705932_465472055589548_1070346545644039642_n.jpg" alt="Course #5">
            <div class="down-content">
              <h4>THE COMMUNAL STUDY SPACE</h4>
              <p>Pellentesque ultricies diam magna, auctor cursus lectus pretium nec. Maecenas finibus lobortis enim.</p>
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('images') }}/299973477_465472148922872_3577177968882640236_n.jpg" alt="Course #6">
            <div class="down-content">
              <h4>ROBOTICS AND AUTOMATION</h4>
              <p>Quisque cursus augue ut velit dictum, quis volutpat enim blandit. Maecenas a lectus ac ipsum porta.</p>
         
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('images') }}/300387148_465472022256218_2303637721217240224_n.jpg" alt="Course #6">
            <div class="down-content">
              <h4>BE OUR PARTNER</h4>
              <p>Pellentesque ultricies diam magna, auctor cursus lectus pretium nec. Maecenas finibus lobortis enim.</p>
            </div>
          </div>
       
   
  
        </div>
      </div>
    </div>
  </section>
  
  <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "105694865647257");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v15.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>


  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p><i class="fa fa-copyright"></i> Copyright 2022 by Balele Intergrated High School
          
           | Design: <a href="https://templatemo.com" rel="sponsored" target="_parent">TemplateMo</a></p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor') }}/jquery/jquery.min.js"></script>
    <script src="{{ asset('vendor') }}/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('web') }}/js/isotope.min.js"></script>
    <script src="{{ asset('web') }}/js/owl-carousel.js"></script>
    <script src="{{ asset('web') }}/js/lightbox.js"></script>
    <script src="{{ asset('web') }}/js/tabs.js"></script>
    <script src="{{ asset('web') }}/js/video.js"></script>
    <script src="{{ asset('web') }}/js/slick-slider.js"></script>
    <script src="{{ asset('web') }}/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .scroll-to-section').on('click', 'a', function (e) {
          if($(e.target).hasClass('external')) {
            return;
          }
          e.preventDefault();
          $('#menu').removeClass('active');
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>
</html>