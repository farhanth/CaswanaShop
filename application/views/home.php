<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Caswana Shop</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="<?=base_url('assets/user/css/bootstrap.min.css')?>" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="<?=base_url('assets/user/css/mdb.min.css')?>" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="<?=base_url('assets/user/css/style.min.css')?>" rel="stylesheet">
  <style type="text/css">
    html,
    body,
    header,
    .carousel {
      height: 60vh;
    }

    @media (max-width: 740px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="<?=base_url()?>">
        <strong class="blue-text">CaswanaShop</strong>
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link waves-effect" href="<?=base_url()?>">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="<?=base_url('#kategori')?>">Kategori</a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="<?=base_url('kontak')?>">Kontak Kami</a>
          </li>
        </ul>

        <!-- Right -->
        <?php
        if ($this->session->userdata('login') == '1') { ?>
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a href="<?=base_url('pembelian')?>" class="nav-link waves-effect mr-3">
                <i class="fas fa-truck"></i>
                <span class="clearfix d-none d-sm-inline-block"> Pembelian </span>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('keranjang')?>" class="nav-link waves-effect mr-3">
                <i class="fas fa-shopping-cart"></i>
                <span class="clearfix d-none d-sm-inline-block"> Keranjang </span>
                <?php 
                  $this->db->where('id_user', $this->session->userdata('id_user'));
                  $this->db->from('keranjang');
                  $total_keranjang = $this->db->count_all_results();
                ?>
                <sup><span class="badge red z-depth-1 p-1"> <?= $total_keranjang ?> </span></sup>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('logout')?>" class="nav-link border border-light rounded waves-effect">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
              </a>
            </li>
          </ul>
        <?php } else{ ?>
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a href="<?=base_url('login')?>" class="nav-link border border-light rounded waves-effect">
                <i class="fas fa-sign-in-alt mr-2"></i>Masuk / Daftar
              </a>
            </li>
          </ul>
        <?php 
        }
        ?>
      </div>

    </div>
  </nav>
  <!-- Navbar -->

  <!--Carousel Wrapper-->
  <div id="carousel-example-1z" class="carousel slide carousel-fade pt-4" data-ride="carousel">

    <!--Indicators-->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-1z" data-slide-to="1"></li>
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">

      <!--First slide-->
      <div class="carousel-item active">
        <div class="view" style="background-image: url('<?=base_url('assets/user/img/slide1.png')?>'); background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Belanja Sepeda Berkualitas di CaswanaShop</strong>
              </h1>

              <p>
                <strong>Toko Online Sepeda Terpercaya</strong>
              </p>

              <p class="mb-4 d-none d-md-block">
                <strong>Lihat berbagai sepeda pilihan dengan kualitas premium dan harga yang bersahabat.</strong>
              </p>

              <a href="#kategori" class="btn btn-outline-white btn-lg">BELANJA SEKARANG
                <i class="fas fa-graduation-cap ml-2"></i>
              </a>
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/First slide-->

      <!--Second slide-->
      <div class="carousel-item">
        <div class="view" style="background-image: url('<?=base_url('assets/user/img/slide2.png')?>'); background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <!-- <div class="mask rgba-black-strong d-flex justify-content-center align-items-center"> -->

            <!-- Content -->
            <!-- <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Learn Bootstrap 4 with MDB</strong>
              </h1>

              <p>
                <strong>Best & free guide of responsive web design</strong>
              </p>

              <p class="mb-4 d-none d-md-block">
                <strong>The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000 users. Video and
                  written versions
                  available. Create your own, stunning website.</strong>
              </p>

              <a target="_blank" href="https://mdbootstrap.com/education/bootstrap/" class="btn btn-outline-white btn-lg">Start
                free tutorial
                <i class="fas fa-graduation-cap ml-2"></i>
              </a>
            </div> -->
            <!-- Content -->

          <!-- </div> -->
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/Second slide-->

    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->

  </div>
  <!--/.Carousel Wrapper-->
  <!--Main layout-->
  <main>
    <div class="container">
      <!--Navbar-->
      <div class="pt-5" id="kategori"></div>
      <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mb-5">

        <!-- Navbar brand -->
        <span class="navbar-brand">Categories:</span>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
          aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

          <!-- Links -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if ($this->session->userdata('kategori') == NULL) { echo "active"; } ?>" >
              <a class="nav-link" href="<?=base_url()?>">Semua
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <?php foreach ($kategori as $data): ?>
            <li class="nav-item <?php if ($this->session->userdata('kategori') == $data['kategori']) { echo "active"; } ?>">
                <a class="nav-link" href="<?=base_url()?>?kategori=<?= $data['kategori']?>"><?= $data['kategori']?></a>
            </li>
            <?php endforeach ?>
          </ul>
          <!-- Links -->

          <form action="<?=base_url()?>" class="form-inline">
            <div class="md-form my-0">
              <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search" id="search" autocomplete="off" <?php if ($this->session->userdata('keyword')) { ?>
                value="<?=$this->session->userdata('keyword')?>"
              <?php } ?> >
            </div>
          </form>
        </div>
        <!-- Collapsible content -->

      </nav>
      <!--/.Navbar-->

      <!--Section: Products v.3-->
      <section class="text-center mb-4">
        <!--Grid row-->
        <div class="row wow fadeIn">
          
          <!--Grid column-->
          <?php foreach ($produk as $data): ?>
          <div class="col-lg-4 col-md-6 mb-4">

            <!--Card-->
            <div class="card">

              <!--Card image-->
              <div class="view overlay">
                <img src="<?=base_url('upload/'.$data['gambar'])?>" class="card-img-top"
                  alt="">
                <a href="<?=base_url('produk/'.$data['id_sepeda'])?>">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!--Card image-->

              <!--Card content-->
              <div class="card-body text-center">
                <!--Category & Title-->
                <a href="<?=base_url()?>?kategori=<?=$data['kategori']?>" class="grey-text">
                  <h5><?= $data['kategori'] ?></h5>
                </a>
                <h5>
                  <strong>
                    <a href="<?=base_url('produk/'.$data['id_sepeda'])?>" class="dark-grey-text"><?= $data['merk'] ?></a>
                  </strong>
                </h5>

                <h4 class="font-weight-bold blue-text">
                  <strong>Rp <?=number_format($data['harga'], 0, ".", ".")?></strong>
                </h4>

              </div>
              <!--Card content-->

            </div>
            <!--Card-->

          </div>
          <?php endforeach ?>
          <!--Grid column-->

        </div>
        <!--Grid row-->

      </section>
      <!--Section: Products v.3-->

      <!--Pagination-->
      <?= $this->pagination->create_links(); ?>
      <!--Pagination-->

    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="page-footer text-center font-small mt-4 wow fadeIn">

    <!--Copyright-->
    <div class="footer-copyright py-3">
      ©2020 Copyright
      <a href="<?=base_url()?>" target="_blank"> Caswanashop </a>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="<?=base_url('assets/user/js/jquery-3.4.1.min.js')?>"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="<?=base_url('assets/user/js/popper.min.js')?>"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="<?=base_url('assets/user/js/bootstrap.min.js')?>"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="<?=base_url('assets/user/js/mdb.min.js')?>"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>
</body>

</html>
