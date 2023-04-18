
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <!-- <link rel="icon" href="images/fevicon.png" type="image/gif" /> -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Plaza Elektronik</title>

  <!-- lokasi js dan css admin LTE di codeigniter -->
  <base href="<?= base_url() ?>">

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
    .nav-link a:active{
      color: #f3c93e;
    }

    html{
      scroll-behavior: smooth;
    }
  </style>

  <?php $this->renderSection('style');?>

</head>

<body>

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section fixed-top">
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="/">
              <span>
                Plaza Elektonik
              </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#produk">Produk</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#cabang">Cabang</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link bg-warning rounded" href="/admin/dashboard">
                    <i class="fa fa-user mr-2" aria-hidden="true"></i>
                      <span>
                         Admin
                      </span>
                  </a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
    
    <?php $this->renderSection('content');?>

  <!-- info section -->
  <section class="info_section ">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="info_contact">
            <h5>
              <a href="" class="navbar-brand">
                <span>
                  Minics
                </span>
              </a>
            </h5>
            <p>
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              Address
            </p>
            <p>
              <i class="fa fa-phone" aria-hidden="true"></i>
              +01 1234567890
            </p>
            <p>
              <i class="fa fa-envelope" aria-hidden="true"></i>
              demo@gmail.com
            </p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="info_info">
            <h5>
              Information
            </h5>
            <p>
              Eligendi sunt, provident, debitis nemo, facilis cupiditate velit libero dolorum aperiam enim nulla iste maxime corrupti ad illo libero minus.
            </p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_links">
            <h5>
              Useful Link
            </h5>
            <ul>
              <li>
                <a href="index.html">
                  Home
                </a>
              </li>
              <li>
                <a href="about.html">
                  About
                </a>
              </li>
              <li>
                <a href="product.html">
                  Products
                </a>
              </li>
              <li>
                <a href="why.html">
                  Why Us
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end info_section -->


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

  <?php $this->renderSection('script');?>
  
  <script>
    // $('.nav-link').addClass('active')
  </script>


</body>

</html>