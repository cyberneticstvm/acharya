<!--
=========================================================
* Soft UI Dashboard - v1.0.7
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ public_path().'/assets/img/apple-icon.png' }}">
  <link rel="icon" type="image/png" href="{{ public_path().'/assets/img/favicon.png' }}">
  <title>
    Acharya Education | Login
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ public_path().'/assets/css/nucleo-icons.css' }}" rel="stylesheet" />
  <link href="{{ public_path().'/assets/css/nucleo-svg.css' }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ public_path().'/assets/css/nucleo-svg.css' }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ public_path().'/assets/css/soft-ui-dashboard.css?v=1.0.7' }}" rel="stylesheet" />
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid pe-0">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="/">
              Acharya Educations - Your Choice Decides Your Destiny!
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  @yield("content")
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> Acharya Educations.
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="{{ public_path().'/assets/js/core/popper.min.js' }}"></script>
  <script src="{{ public_path().'/assets/js/core/jquery.min.js' }}"></script>
  <script src="{{ public_path().'/assets/js/core/bootstrap.min.js' }}"></script>
  <script src="{{ public_path().'/assets/js/plugins/perfect-scrollbar.min.js' }}"></script>
  <script src="{{ public_path().'/assets/js/plugins/smooth-scrollbar.min.js' }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    $(function(){
      $('form').submit(function(){
        $(".btn-submit").attr("disabled", true);
        $(".btn-submit").html("<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span>");
      });

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    });
    setTimeout(function () {
        $(".alert").hide('slow');
    }, 3000);
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ public_path().'/assets/js/soft-ui-dashboard.min.js?v=1.0.7' }}"></script>
</body>

</html>