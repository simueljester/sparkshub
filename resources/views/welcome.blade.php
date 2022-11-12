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

    <title>BOOT NHS</title>
    <link rel="icon" href="{{ asset('images') }}/bootnhslogo.png">
  
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
      <a href="/"> <img src="{{ asset('images') }}/bootnhslogo.png" width="50" alt=""> <em>BOOT</em> National High School</a>
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
        <li><a href="#section5">Parola</a></li>
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
             <a href="/"> <img src="{{ asset('images') }}/bootnhslogo.png" width="100" alt=""></a>
             <br> 
             <h6 class="mt-1">Tanauan City</h6>
              <h2><em>BOOT</em> National High School  </h2>
         
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
                <h4><i class="fa fa-pencil"></i> About Boot </h4>
              </div>
              <div class="content-hide">
                <p> Boot NHS is located at Purok 5, Boot, Tanauan City, Tanauan, Philippines, 4232 </p>
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
            <h2>BOOT NHS</h2>
          </div>
        </div>
        <div class="col-md-12">
          <div id='tabs'>
            <ul>
              <li><a href='#tabs-1'>Best Education</a></li>
              {{-- <li><a href='#tabs-2'>Top Management</a></li>
              <li><a href='#tabs-3'>Quality Meeting</a></li> --}}
            </ul>
            <section class='tabs-content'>
              <article id='tabs-1'>
                <div class="row">
                  <div class="col-md-6">
                    <img src="{{ asset('images') }}/293067293_5335093776556293_8162669428780072474_n.jpg" alt="">
                  </div>
                  <div class="col-md-6">
                    <h4>BOOT Family</h4>
                    {{-- <p>Grad School is free educational HTML template with Bootstrap 4.5.2 CSS layout. Feel free to use it for educational or commercial purposes. You may want to make <a href="https://paypal.me/templatemo" target="_parent" rel="sponsored">a little donation</a> to TemplateMo. Please tell your friends about us. Thank you.</p> --}}
                  </div>
                </div>
              </article>
              {{-- <article id='tabs-2'>
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
              </article> --}}
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
                <h4> Our new online library platform <em> PAROLA </em></h4>
                <p>Parola is a virtual library for Boot NHS students. Books and Modules management console provides easy access for borrowing, tracking and monitoring of borrowed books inside the library of Boot NHS.
                <br><br>It also aims to provide our teachers and librarians to easily upload contents accessible by students </p>
                <div class="main-button"><a rel="nofollow" href="/login" target="_parent">Start your experience</a></div>
            </div>
            </div>
            <div class="col-md-6">
            <article class="video-item">
                <a href="/login"><img class="ml-5" src="{{ asset('images') }}/315248603_427590252915084_6505475989415432111_n.jpg" width="400"></a>
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
            <h2> PAROLA </h2>
          </div>
        </div>
        <div class="owl-carousel owl-theme">
       
          <div class="item">
            <img src="{{ asset('images') }}/315248603_427590252915084_6505475989415432111_n.jpg" alt="Course #2">
            <div class="down-content">
              <h4>Librarian</h4>
              <p>Teressa B. Oña</p>
          
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('images') }}/314346940_626280582622843_3116226670530069108_n.jpg" alt="Course #2">
            <div class="down-content">
              <h4>Earthquake Drill</h4>
              <p>Sabay-sabay na nag-DUCK, COVER and HOLD ang mga guro at mag-aaral ng Boot High bilang pakikiisa sa isinigawang Fourth Quarter Nationwide Simultaneous Earthquake Drill (NSED) ngayong araw, ika-10 ng Nobyembre 2022, sa ganap na ika-9 ng umaga. Ito ay para sa  patuloy na pagpapaigting ng kahandaan ng bawat isa sa oras ng kalamidad at sakuna.</p>
          
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('images') }}/314604222_625344846049750_2207003804842982810_n.jpg" alt="Course #2">
            <div class="down-content">
              <h4>School Governance Council</h4>
              <p>
                Isinagawa ang School Governance Council validation sa pangunguna nina  Gng. Gerlie Lopez, EPS-SGOD, at G. Maximo Custodio, SGOD Chief.
              </p>
          
            </div>
          </div>
          <div class="item">
            <img src="{{ asset('images') }}/311024046_609595340958034_524152786424996844_n.jpg" alt="Course #2">
            <div class="down-content">
              <h4>Global Hand Washing Day </h4>
              <p>
                Bilang pakikiisa ng Boot National High School sa GLOBAL HANDWASHING DAY 2022 na may temang “Unite for Universal Hand Hygiene” sa pangunguna ng SSG Officers at Yes-O Club Officers kasama ang ilan pang mga guro, tinalakay at isinagawa ang tamang proseso ng paghuhugas ng kamay upang ang bawat isa ay manatiling ligtas at malayo sa anumang karamdaman. 
              </p>
          
            </div>
          </div>

          <div class="item">
            <img src="{{ asset('images') }}/309506605_593055665945335_7638720675112248542_n.jpg" alt="Course #2">
            <div class="down-content">
              <h4>Agrifarm </h4>
              <p>
                Patuloy ang pagsuporta ng Pamahalaang Lungsod ng Tanauan sa pagpapalawig ng mga programa sa ilalim ng Gulayan sa Paaralan (GPP) gaya ng Project AGRI-Kultura, Organic Garden Model (OGM) at AGRI-Farm.
              </p>
          
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
          <p><i class="fa fa-copyright"></i> Copyright 2022 by Boot NHS High School
          
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