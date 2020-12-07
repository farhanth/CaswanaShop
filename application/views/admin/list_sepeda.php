<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="mt-2 font-weight-bold text-primary float-left">List Sepeda</h6>
            <a href="<?=base_url('admin/tambah_sepeda')?>" class="btn btn-success float-right">
                <i class="fas fa-fw fa-plus mr-2"></i>Tambah Sepeda
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php if ($this->session->userdata('pesan') == 'ditambah') : ?>
                    <div class="alert alert-success mb-3" role="alert">
                        Sepeda berhasil ditambah.
                    </div>
                <?php elseif ($this->session->userdata('pesan') == 'dihapus') : ?>
                    <div class="alert alert-success mb-3" role="alert">
                        Sepeda berhasil dihapus.
                    </div>
                <?php elseif ($this->session->userdata('pesan') == 'diubah') : ?>
                    <div class="alert alert-success mb-3" role="alert">
                        Sepeda berhasil diedit.
                    </div>
                <?php elseif ($this->session->userdata('error')) : ?>
                    <div class="alert alert-danger mb-3" role="alert">
                        <?= $this->session->userdata('error') ?>
                    </div>
                <?php endif ?>
                <table class="table table-bordered" id="list_sepeda" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Merk</th>
                            <th class="text-center">Harga (Rp)</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sepeda as $data): ?>
                        <tr>
                            <td class="text-center"></td>
                            <td>
                                <a target="_blank" href="<?=base_url('?kategori='.$data['kategori'])?>"><?= $data['kategori'] ?></a>
                            </td>
                            <td>
                                <a target="_blank" href="<?=base_url('produk/'.$data['id_sepeda'])?>"><?= $data['merk'] ?></a>
                            </td>
                            <td><?= number_format($data['harga'], 0, ",", ",") ?></td>
                            <td>
                                <div class=text-center>
                                    <a href="<?=base_url('admin/edit_sepeda/'.$data['id_sepeda'])?>" class="edit_record btn btn-info btn-xs">Edit</a>
                                    
                                    <a href="#" class="hapus_record btn btn-danger btn-xs" data-toggle="modal" data-target="#ModalHapus<?= $data['id_sepeda'] ?>">Hapus</a>

                                    
                                    <!-- Modal Delete-->
                                    <form action="<?= base_url('admin/delete_sepeda') ?>" method="post">
                                        <div class="modal" id="ModalHapus<?= $data['id_sepeda'] ?>" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content bg-ligh">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus User</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_sepeda" value="<?= $data['id_sepeda'] ?>" class="form-control" required>
                                                        <p class="text-left">Anda yakin ingin menghapus produk sepeda ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Modal Delete End-->
                                </div>
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
        var list_sepeda = $('#list_sepeda').DataTable( {
            "columnDefs": [ {
                'targets': 'no-sort',
                'searchable': false,
                'orderable': false
            } ],
            "order": [ 2, 'asc' ]
        } );

        list_sepeda.on( 'order.dt search.dt', function () {
            list_sepeda.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    });
</script>