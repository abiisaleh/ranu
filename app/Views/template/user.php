<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Plaza Elektronik</title>

  <!-- lokasi js dan css admin LTE di codeigniter -->
  <base href="<?= base_url() ?>/">

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="dist2/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="dist2/https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet"> <!-- range slider -->

  <!-- font awesome style -->
  <link href="dist2/css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="dist2/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="dist2/css/responsive.css" rel="stylesheet" />

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">


  <style>
    .nav-link a:active {
      color: #f3c93e;
    }

    html {
      scroll-behavior: smooth;
    }
  </style>

  <?php $this->renderSection('style'); ?>

</head>

<body>

  <div class="hero_area">
    <?= $this->include('template/_navbar'); ?>

    <?php $this->renderSection('content'); ?>

    <?= $this->include('template/_footer'); ?>

    <!-- footer section -->
    <footer class="footer_section">
      <div class="container">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Plaza Elektronik Jayapura</a>
        </p>
      </div>
    </footer>
    <!-- footer section -->

    <!-- jQery -->
    <script src="dist2/js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="dist2/js/bootstrap.js"></script>

    <!-- custom js -->
    <script src="dist2/js/custom.js"></script>

    <!-- SweetAlert2 -->
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>

    <?php $this->renderSection('script'); ?>

    <script>
      // $('.nav-link').addClass('active')
    </script>


</body>

</html>