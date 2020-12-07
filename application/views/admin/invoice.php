<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Invoice Pembelian</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php if ($this->session->userdata('status') == 'diubah') : ?>
                    <div class="alert alert-success mb-3" role="alert">
                        Status invoice berhasil diubah.
                    </div>
                <?php endif ?>
                <table class="table table-bordered" id="list_keranjang" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">No. Invoice</th>
                            <th class="text-center">Tanggal Pembelian</th>
                            <th class="text-center">Total (Rp.)</th>
                            <th class="text-center">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($invoice as $data): ?>
                        <tr>
                            <th class="text-center" scope="row"><?=$no++?></th>
                            <td scope="row"><?=$data['no_invoice']?></td>
                            <td scope="row">
                              <?=date('d M Y - h:i:s', strtotime($data['tanggal_invoice']))?>
                            </td>
                            <td scope="row"><?=number_format($data['harga_invoice_total'], 0, ".", ".")?></td>
                            <td scope="row">
                                <form method="post" id="status_form<?=$data['no_invoice']?>">
                                    <div class="form-group">
                                        <input type="hidden" name="no_invoice[]" value="<?=$data['no_invoice']?>">
                                        <select class="form-control status" name="status[]" data-id="<?=$data['no_invoice']?>">
                                          <option value="Menunggu Pembayaran" <?php if($data['status'] == 'Menunggu Pembayaran'){ ?> selected="selected" <?php } ?>>Menunggu Pembayaran</option>
                                          <option value="Menunggu Verifikasi" <?php if($data['status'] == 'Menunggu Verifikasi'){ ?> selected="selected" <?php } ?>>Menunggu Verifikasi</option>
                                          <option value="Terverifikasi" <?php if($data['status'] == 'Terverifikasi'){ ?> selected="selected" <?php } ?>>Terverifikasi</option>
                                          <option value="Pesanan Dikirim" <?php if($data['status'] == 'Pesanan Dikirim'){ ?> selected="selected" <?php } ?>>Pesanan Dikirim</option>
                                        </select>
                                    </div>
                                </form>
                            </td>
                            <td class="text-center">
                                <?php if ($data['status'] != 'Menunggu Pembayaran' && $data['bukti_transfer'] != NULL): ?>
                                    <a href="<?=base_url('admin/download/'.$data['bukti_transfer'])?>" class="btn btn-sm btn-primary">
                                        Lihat Bukti Transfer
                                    </a>
                                <?php endif ?>
                                <a href="<?=base_url('admin/detail_invoice/'.$data['no_invoice'])?>" class="btn btn-sm btn-success">
                                  Lihat Detail
                                </a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
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