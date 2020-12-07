<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Keranjang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="list_keranjang" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Merk Sepeda</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Total Harga (Rp.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($keranjang as $data): ?>
                        <tr>
                            <td class="text-center"></td>
                            <td><?= $data['nama_lengkap'] ?></td>
                            <td><?= $data['merk'] ?></td>
                            <td><?= $data['jumlah'] ?></td>
                            <td><?= number_format($data['harga'] * $data['jumlah'], 0, ",", ",") ?></td>
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
</script>