<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>My Portfolio</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('assets/vendor') }}/icofont/icofont.min.css" rel="stylesheet">
  <link href="{{ asset('assets/vendor') }}/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('assets/vendor') }}/venobox/venobox.css" rel="stylesheet">
  <link href="{{ asset('assets/vendor') }}/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="{{ asset('assets/vendor') }}/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: iPortfolio - v1.5.1
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

  <!-- ======= Header ======= -->
  @include('portfolio.includes.header')
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Portfoio Details : {{ $project['title'] }}</h2>
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>Portfoio Details</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="portfolio-details-container">

          <div class="owl-carousel portfolio-details-carousel">
            @forelse ($project['images'] as $item)
            <img src="{{ asset('assets/img/portfolio/projects/' . $item ) }}" class="img-fluid" alt="">
            @empty
                
            @endforelse
            
            {{-- <img src="assets/img/portfolio-details-2.jpg" class="img-fluid" alt="">
            <img src="assets/img/portfolio-details-3.jpg" class="img-fluid" alt=""> --}}
          </div>

          <div class="portfolio-info">
            <h3>Project information</h3>
            <ul>
              <li><strong>Category</strong>: {{ $project['category'] }}</li>
              <li><strong>Client</strong>: {{ $project['client'] }}</li>
              <li><strong>Project date</strong>: {{ $project['project_date'] }}</li>
              <li><strong>Project URL</strong>: <a href="#">www.example.com</a></li>
            </ul>
          </div>

        </div>

        <div class="portfolio-description">
          <h2>This is an example of portfolio detail</h2>
          <p>
            {{ $project['description'] }}
          </p>
        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('portfolio.includes.footer')
  <!-- End  Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor') }}/jquery/jquery.min.js"></script>
  <script src="{{ asset('assets/vendor') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/vendor') }}/jquery.easing/jquery.easing.min.js"></script>
  <script src="{{ asset('assets/vendor') }}/php-email-form/validate.js"></script>
  <script src="{{ asset('assets/vendor') }}/waypoints/jquery.waypoints.min.js"></script>
  <script src="{{ asset('assets/vendor') }}/counterup/counterup.min.js"></script>
  <script src="{{ asset('assets/vendor') }}/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ asset('assets/vendor') }}/venobox/venobox.min.js"></script>
  <script src="{{ asset('assets/vendor') }}/owl.carousel/owl.carousel.min.js"></script>
  <script src="{{ asset('assets/vendor') }}/typed.js/typed.min.js"></script>
  <script src="{{ asset('assets/vendor') }}/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets') }}/js/main.js"></script>

</body>

</html>