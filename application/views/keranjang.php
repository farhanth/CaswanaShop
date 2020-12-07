<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Keranjang</title>
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

<body class="grey lighten-3">

  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="<?=base_url()?>">
        <strong class="blue-text">CaswanaShop</strong>
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
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
  <main class="mt-5 pt-4" style="min-height: 100vh">
    <div class="container wow fadeIn">

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-12 pt-4 mb-4">

          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Isi Keranjang Anda</span>
            <span class="badge badge-secondary badge-pill"><?=$total_keranjang?></span>
          </h4>

          <?php if ($this->session->flashdata('keranjang') == 'dihapus'): ?>
            <div class="alert alert-success" role="alert">
              Berhasil menghapus sepeda dari keranjang.
            </div>
          <?php endif ?>

          <!-- Cart -->
          <ul class="list-group mb-3 z-depth-1">
            <?php
            $harga_total = 0;
            if (empty($keranjang)) { ?>
            <li class="list-group-item lh-condensed">
              <div class="row">
                <div class="col-md-12 text-center py-4">
                  <h4>Keranjang anda masih kosong</h4>
                  <h5>Ayo belanja dan masukan barang ke keranjang</h5>
                  <a href="<?=base_url('#kategori')?>" class="m-3 btn px-5 py-3 btn-outline-dark btn-md waves-effect m-0" type="button">Lanjut Belanja</a>
                </div>
              </div>
            </li>
            <?php } else {
            foreach ($keranjang as $data): ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div class="row w-100">
                <div class="col-lg-4 col-md-6">
                  <img src="<?=base_url('upload/'.$data['gambar'])?>" class="rounded img-thumbnail">
                </div>
                <div class="col-lg-8 col-md-6 my-auto">
                  <h2 class="mt-0 mb-1"><?=$data['merk']?></h2>
                  <h4 class="text-muted mb-3">(Rp <?=number_format($data['harga'], 0, ".", ".")?>) </h4>
                  <form action="" method="post">
                    <div class="custom-file d-flex">
                      <a href="<?=base_url('user/kurang/'.$data['id_keranjang']."/".$data['jumlah'])?>" class="my-auto py-2 px-3 btn btn-info">
                        <i class="fas fa-minus"></i>
                      </a>

                      <input type="text" onkeypress="return onlyNumberKey(event)" value="<?=$data['jumlah']?>" min="1" class="form-control text-center jumlah" style="width: 100px" name="jumlah" id="jumlah<?= $data['id_keranjang'] ?>" readonly required>

                      <a href="<?=base_url('user/tambah/'.$data['id_keranjang']."/".$data['jumlah'])?>" class="my-auto py-2 px-3 btn btn-info">
                        <i class="fas fa-plus"></i>
                      </a>

                      <button type="button" class="my-auto ml-5 py-2 px-3 btn btn-danger hapus" data-toggle="modal" data-target="#ModalHapus<?= $data['id_keranjang'] ?>">
                        <i class="fas fa-trash"></i>
                      </button>

                      <!-- Modal Delete-->
                      <form action="<?= base_url('user/delete_keranjang') ?>" method="post">
                        <div class="modal" id="ModalHapus<?= $data['id_keranjang'] ?>" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content bg-ligh">
                              <div class="modal-header">
                                <h5 class="modal-title">Hapus Keranjang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <input type="hidden" name="id_keranjang" value="<?= $data['id_keranjang'] ?>" class="form-control" required>
                                <p class="text-left">Anda yakin ingin menghapus barang ini dari keranjang?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                                <button type="button" class="btn bg-white" data-dismiss="modal">Batal</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                      <!-- Modal Delete End-->
                    </div>
                  </form>
                  <?php
                    $harga_satuan_total = $data['harga'] * $data['jumlah'];
                    $harga_total += $harga_satuan_total;
                  ?>
                  <h5 class="text-muted mt-5">Rp <?=number_format($harga_satuan_total, 0, ".", ".")?></h5>
                </div>
              </div>
            </li>
            <?php endforeach ?>
            <li class="list-group-item d-flex justify-content-between">
              <h2>Total</h2>
              <strong><h2>Rp <?=number_format($harga_total, 0, ".", ".")?></h2></strong>
            </li>
          </ul>
          <!-- Cart -->

          <!-- Button -->
          <div class="text-center">
            <a href="<?=base_url('#kategori')?>" class="m-3 btn px-5 py-3 btn-outline-dark btn-md waves-effect m-0" type="button">Lanjut Belanja</a>
            <a href="<?=base_url('checkout')?>" class="m-3 btn px-5 py-3 btn-primary btn-md waves-effect m-0" type="button">Checkout</a>
          </div>
          <!-- Button -->
          <?php } ?>

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

  <!-- SCRIPTS -->
  <script>
    function onlyNumberKey(evt) { 
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
    } 
  </script>

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
