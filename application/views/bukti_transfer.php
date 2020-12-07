<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Upload Bukti Transfer - <?=$no_invoice?></title>
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
  <main class="mt-5 pt-4" style="min-height: 89vh">
    <div class="container wow fadeIn">
      <ul class="my-5 list-group mb-3 z-depth-1">
        <li class="list-group-item lh-condensed">
          <div class="row">
            <div class="col-md-12 text-center mb-4">
              <h4>Upload Bukti Transfer (<?=$no_invoice?>)</h4>
            </div>
          </div>
          <div class="container row">
            <div class="col-md-12">
              <form action="" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                <div class="form-group mb-0">
                  <label for="gambar">Foto Bukti Transfer</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input input-foto form-control" id="gambar" accept=".png, .jpg, .jpeg" name="gambar" required>
                    <label class="custom-file-label" for="gambar">Pilih foto bukti transfer...</label>
                  </div>
                  <img src="" class="rounded mx-auto d-block img-fluid mt-3" style="max-width: 25vw;" id="preview">
                  <div class="invalid-feedback">
                    Anda belum memilih foto.
                  </div>
                </div>
                <div class="text-right">
                  <button class="mb-3 btn px-5 py-3 btn-primary btn-md waves-effect m-0" type="submit" name="upload">Upload</button>
                </div>
              </form>
            </div>
          </div>
        </li>
      </ul>
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
    document.querySelector('.input-foto').addEventListener('change', function(e) {
        var fileName = document.getElementById("gambar").files[0].name;
        console.log(fileName);
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
    })

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }

    $(".input-foto").change(function() {
      readURL(this);
    });
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
