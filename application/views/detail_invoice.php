<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Detail invoice - <?=$no_invoice['no_invoice']?></title>
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
      <?php if (empty($invoice)): ?>
      <ul class="my-5 list-group mb-3 z-depth-1">
        <li class="list-group-item lh-condensed">
          <div class="row">
            <div class="col-md-12 text-center py-4">
              <h4>Invoice Tidak Ditemukan</h4>
              <a href="<?=base_url()?>" class="m-3 btn px-5 py-3 btn-outline-dark btn-md waves-effect m-0" type="button">Kembali</a>
            </div>
          </div>
        </li>
      </ul>

      <?php else: ?>
      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Detail Invoice (<?=$no_invoice['no_invoice']?>)</h2>

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-8 mb-4">

          <!--Card-->
          <div class="card">
            <!--Card content-->
            <form class="card-body" method="post">
              <h4 class="text-center">Data Penerima</h4>
              <div class="md-form mb-4">
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="<?=$no_invoice['nama_lengkap_penerima']?>" maxlength="64" required readonly>
                <label for="nama_lengkap" class="">Nama Lengkap</label>
              </div>

              <div class="md-form mb-4">
                <input type="text" id="email" name="email" class="form-control" value="<?=$no_invoice['email_penerima']?>" maxlength="64" required readonly>
                <label for="email" class="">Email</label>
              </div>

              <div class="md-form mb-4">
                <input type="text" id="no_tlp" name="no_tlp" class="form-control" value="<?=$no_invoice['no_tlp_penerima']?>" maxlength="16" required readonly>
                <label for="no_tlp" class="">No. Telepon</label>
              </div>

              <div class="md-form mb-4">
                <input type="text" id="area" name="area" class="form-control" value="<?=$no_invoice['area']?>" maxlength="16" required readonly>
                <label for="area" class="">Area</label>
              </div>

              <div class="md-form mb-4">
                <input type="text" id="alamat_lengkap" name="alamat_lengkap" class="form-control" value="<?=$no_invoice['alamat_lengkap']?>" maxlength="16" required readonly>
                <label for="alamat_lengkap" class="">Alamat Lengkap</label>
              </div>

              <div class="md-form mb-4">
                <input type="text" id="kode_pos" name="kode_pos" class="form-control" value="<?=$no_invoice['kode_pos']?>" maxlength="16" required readonly>
                <label for="kode_pos" class="">Kode Pos</label>
              </div>

              <h4 class="text-center">Metode Pembayaran</h4>

              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                  <label class="custom-control-label" for="credit">Bank BRI</label>
                </div>
              </div>
              <div class="row mb-0">
                <div class="col-lg-6 col-md-6 mb-0">
                  <label for="nama_rek">Nama Rekening Anda</label>
                  <input value="<?=$no_invoice['nama_rek']?>" readonly type="text" class="form-control" id="nama_rek" name="nama_rek" required autocomplete="off" maxlength="128">
                </div>
                <div class="col-lg-6 col-md-6 mb-0">
                  <label for="no_rek">Nomor Rekening Anda</label>
                  <input value="<?=$no_invoice['no_rek']?>" readonly type="text" class="form-control" id="no_rek" name="no_rek" required autocomplete="off" onkeypress="return onlyNumberKey(event)" maxlength="64">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <small class="text-muted">Nama dan nomor rekening hanya untuk validasi data pembayaran.</small>
                </div>
              </div>

            </form>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-4 mb-4">

          <!-- Cart -->
          <ul class="list-group mb-3 z-depth-1">
            <?php
            $harga_total = 0;
            foreach ($invoice as $data): ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0 text-black">
                  <?= "(".$data['jumlah'].") ".$data['merk']?>
                </h6>
                <h6 class="text-muted">Rp <?=number_format($data['harga_barang_total'], 0, ".", ".")?></h6>
              </div>
              <span class="text-muted"></span>
            </li>
            <?php endforeach ?>
            <?php if ($no_invoice['area'] == 'Jabodetabek'): ?>
              <li class="list-group-item d-flex justify-content-between jabodetabek">
                <div>
                  <h6 class="my-0 text-black">
                    <span>Ongkos Kirim (Jabodetabek)</span>
                  </h6>
                  <h6 class="text-muted">Rp <?=number_format(75000, 0, ".", ".")?></h6>
                </div>
              </li>
            <?php else: ?>
              <li class="list-group-item d-flex justify-content-between jabodetabek">
                <div>
                  <h6 class="my-0 text-black">
                    <span>Ongkos Kirim (Luar Jabodetabek)</span>
                  </h6>
                  <h6 class="text-muted">Rp <?=number_format(150000, 0, ".", ".")?></h6>
                </div>
              </li>
            <?php endif ?>
          </ul>
          <ul class="list-group mb-3 z-depth-1">
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (Rp)</span>
              <strong id="harga_total"><?=number_format($no_invoice['harga_invoice_total'], 0, ".", ".")?></strong>
            </li>
          </ul>
          <!-- Cart -->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->
      <?php endif ?>
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

    function formatRupiah(angka){
      var  bilangan = angka;

      var reverse = bilangan.toString().split('').reverse().join(''),
      ribuan  = reverse.match(/\d{1,3}/g);
      ribuan  = ribuan.join('.').split('').reverse().join('');

      return ribuan;
    }

    $("#area").change(function() {
      var harga_total = <?php echo $harga_total; ?>;
      if ($(this).val() == 'Jabodetabek'){
        $("#ongkir_text").attr('class', 'd-none');
        $("#ongkir_jabodetabek").attr('class', 'd-inline-block');
        $("#ongkir_luar_jabodetabek").attr('class', 'd-none');
        $("#harga_total").html(formatRupiah(harga_total+75000));
        $("#harga_total_post").val(harga_total+75000);
      }else if ($(this).val() == 'Luar Jabodetabek'){
        $("#ongkir_text").attr('class', 'd-none');
        $("#ongkir_jabodetabek").attr('class', 'd-none');
        $("#ongkir_luar_jabodetabek").attr('class', 'd-inline-block');
        $("#harga_total").html(formatRupiah(harga_total+150000));
        $("#harga_total_post").val(harga_total+150000);
      }else{
        $("#ongkir_text").attr('class', 'd-inline-block');
        $("#ongkir_jabodetabek").attr('class', 'd-none');
        $("#ongkir_luar_jabodetabek").attr('class', 'd-none');
        $("#harga_total").html(formatRupiah(harga_total));
        $("#harga_total_post").val(harga_total);
      }
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
