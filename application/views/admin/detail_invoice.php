<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Invoice (<?=$no_invoice['no_invoice']?>)</h6>
        </div>
        <div class="card-body">
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
                        <label for="nama_lengkap" class="">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="<?=$no_invoice['nama_lengkap_penerima']?>" maxlength="64" required readonly>
                    </div>

                    <div class="md-form mb-4">
                        <label for="email" class="">Email</label>
                        <input type="text" id="email" name="email" class="form-control" value="<?=$no_invoice['email_penerima']?>" maxlength="64" required readonly>
                    </div>

                    <div class="md-form mb-4">
                        <label for="no_tlp" class="">No. Telepon</label>
                        <input type="text" id="no_tlp" name="no_tlp" class="form-control" value="<?=$no_invoice['no_tlp_penerima']?>" maxlength="16" required readonly>
                    </div>

                    <div class="md-form mb-4">
                        <label for="area" class="">Area</label>
                        <input type="text" id="area" name="area" class="form-control" value="<?=$no_invoice['area']?>" maxlength="16" required readonly>
                    </div>

                    <div class="md-form mb-4">
                        <label for="alamat_lengkap" class="">Alamat Lengkap</label>
                        <input type="text" id="alamat_lengkap" name="alamat_lengkap" class="form-control" value="<?=$no_invoice['alamat_lengkap']?>" maxlength="16" required readonly>
                    </div>

                    <div class="md-form mb-4">
                        <label for="kode_pos" class="">Kode Pos</label>
                        <input type="text" id="kode_pos" name="kode_pos" class="form-control" value="<?=$no_invoice['kode_pos']?>" maxlength="16" required readonly>
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
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    $(document).ready(function() {
        var list_keranjang = $('#list_keranjang').DataTable( {
            "columnDefs": [ {
                'targets': 'no-sort',
                'searchable': false,
                'orderable': false
            } ],
            "order": [ 1, 'asc' ]
        } );

        list_keranjang.on( 'order.dt search.dt', function () {
            list_keranjang.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    });

    $( ".status" ).change(function() {
        no_invoice = $(this).data('id');
        $( "#status_form"+no_invoice ).submit();
    });
</script>