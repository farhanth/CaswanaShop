<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?=$produk['merk']." - ".$produk['kategori']?></title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="<?=base_url('assets/user/css/bootstrap.min.css')?>" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="<?=base_url('assets/user/css/mdb.min.css')?>" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="<?=base_url('assets/user/css/style.min.css')?>" rel="stylesheet">
  <!-- JQuery -->
  <script type="text/javascript" src="<?=base_url('assets/user/js/jquery-3.4.1.min.js')?>"></script>
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
          <li class="nav-item">
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

  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 mb-4">
          <img src="<?=base_url('upload/'.$produk['gambar'])?>" class="img-fluid" alt="">

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Content-->
          <div class="px-4 pb-4 pt-0">

            <div class="mb-3">
              <?php if ($this->session->userdata('keranjang') == 'berhasil') : ?>
                <script>
                  $(window).on('load',function(){
                    $('#keranjangBerhasil').modal('show');
                  });

                  setTimeout(function(){
                    $('#keranjangBerhasil').modal('hide')
                  }, 2000);
                </script>
              <?php endif ?>
              <h4 class="mb-0 h4"><?= $produk['merk']?></h4>
              <a href="<?=base_url()?>?kategori=<?=$produk['kategori']?>">
                <span class="badge blue mr-1"><?=$produk['kategori']?></span>
              </a>
            </div>

            <p class="lead">
              <span>Rp <?=number_format($produk['harga'], 0, ".", ".")?></span>
            </p>

            <p class="lead font-weight-bold">Deskripsi</p>

            <p class="text-justify"><?=$produk['deskripsi']?></p>

            <form method="post" class="d-flex justify-content-left" novalidate>
              <input type="hidden" value="<?=$produk['id_sepeda']?>" class="form-control" style="width: 100px" name="id_sepeda">
              <input type="number" value="1" min="1" class="form-control" style="width: 100px" name="jumlah" required>
              <button class="btn btn-primary btn-md my-0 p" type="submit" name="keranjang">Tambah Ke Keranjang
                <i class="fas fa-shopping-cart ml-1"></i>
              </button>
            </form>

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr>

      <!--Grid row-->
      <div class="row d-flex justify-content-center wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 text-center mb-3">

          <!-- <h2 class="my-4 h2">Spesifikasi</h2> -->

          <p><?= $produk['spesifikasi']?></p>

          

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

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

  <!-- Modal -->
  <div class="modal fade" id="keranjangBerhasil" tabindex="-1" role="dialog" aria-labelledby="keranjangBerhasilTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="keranjangBerhasilTitle">Informasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Berhasil Menambah Barang ke Keranjang
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPTS -->
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
