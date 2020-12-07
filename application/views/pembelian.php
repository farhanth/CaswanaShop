<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Pembelian</title>
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
            <span class="text-muted">Cara Pembayaran</span>
          </h4>

          <ul class="list-group mb-3 z-depth-1">
            <li class="list-group-item lh-condensed">
              <div class="row">
                <div class="col-md-12 py-2">
                  <ol>
                    <li>Transfer melalui rekening BRI ke 719701005352531 a/n Echa   Caswana</li>
                    <li>Jumlah transfer harus sesuai dengan total invoice anda</li>
                    <li>Setelah transfer, simpan bukti transfer kemudian upload   dibagian 'UPLOAD BUKTI TRANSFER'. Pastikan anda mengupload foto   bukti transfer yang benar.</li>
                    <li>Invoice anda akan segera di verifikasi oleh kami</li>
                  </ol>
                </div>
              </div>
            </li>
          </ul>

          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Invoice Anda</span>
            <span class="badge badge-secondary badge-pill"><?= count($no_invoice) ?></span>
          </h4>

          <ul class="list-group mb-3 z-depth-1">
            <?php if ($this->session->flashdata('invoice') == 'checkout'): ?>
              <div class="alert alert-success" role="alert">
                Berhasil checkout keranjang. Silahkan selesaikan pembayaran.
              </div>
            <?php elseif ($this->session->flashdata('bukti_transfer') == 'berhasil'): ?>
              <div class="alert alert-success" role="alert">
                Berhasil upload bukti transfer
              </div>
            <?php endif ?>
            <?php
            $harga_total = 0;
            if (empty($no_invoice)) { ?>
            <li class="list-group-item lh-condensed">
              <div class="row">
                <div class="col-md-12 text-center py-4">
                  <h4>Anda belum memiliki invoice</h4>
                  <h5>Anda akan mendapatkan invoice setelah checkout keranjang</h5>
                  <a href="<?=base_url('keranjang')?>" class="m-3 btn px-5 py-3 btn-outline-dark btn-md waves-effect m-0" type="button">Lihat Keranjang</a>
                </div>
              </div>
            </li>
            <?php } else { ?>
            <table class="table bg-white table-hover mb-0">
              <thead>
                <tr>
                  <th class="text-center" scope="col">No</th>
                  <th scope="col">No. Invoice</th>
                  <th scope="col">Tanggal Pembelian</th>
                  <th scope="col">Total (Rp.)</th>
                  <th scope="col">Status</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($no_invoice as $data): ?>
                  <tr>
                    <th class="text-center" scope="row"><?=$no++?></th>
                    <td scope="row"><?=$data['no_invoice']?></td>
                    <td scope="row">
                      <?=date('d M Y - h:i:s', strtotime($data['tanggal_invoice']))?>
                    </td>
                    <td scope="row"><?=number_format($data['harga_invoice_total'], 0, ".", ".")?></td>
                    <td scope="row"><?=$data['status']?></td>
                    <td scope="row" class="my-auto" style="max-width:23vw">
                      <div class="d-flex justify-content-center">
                        <?php if ($data['status'] == 'Menunggu Pembayaran'): ?>
                          <a href="<?=base_url('user/bukti_transfer/'.$data['no_invoice'])?>" class="mx-3 btn btn-sm rounded btn-primary">
                            Upload Bukti Transfer
                          </a>
                        <?php else: ?>
                          <a href="<?=base_url('user/download/'.$data['bukti_transfer'])?>" class="mx-3 btn btn-sm rounded btn-primary">
                            Lihat Bukti Transfer
                          </a>
                        <?php endif ?>
                        <a target="_blank" href="<?=base_url('user/detail_invoice/'.$data['no_invoice'])?>" class="mx-3 btn btn-sm rounded btn-success">
                          Lihat Detail
                        </a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </ul>

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
