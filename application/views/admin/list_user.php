<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php if ($this->session->userdata('pesan') == 'dihapus') : ?>
                    <div class="alert alert-success mb-3" role="alert">
                        User berhasil dihapus.
                    </div>
                <?php elseif ($this->session->userdata('pesan') == 'diubah') : ?>
                    <div class="alert alert-success mb-3" role="alert">
                        User berhasil diedit.
                    </div>
                <?php endif ?>
                <table class="table table-bordered" id="list_user" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">No. Telepon</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user as $data): ?>
                        <tr>
                            <td class="text-center"></td>
                            <td><?= $data['nama_lengkap'] ?></td>
                            <td><?= $data['email'] ?></td>
                            <td><?= $data['no_tlp'] ?></td>
                            <td><?= $data['jk'] ?></td>
                            <td>
                                <div class=text-center>
                                    <a href="edit_user/<?= $data['id_user'] ?>" class="edit_record btn btn-info btn-xs">Edit</a>
                                    <a href="#" class="hapus_record btn btn-danger btn-xs" data-toggle="modal" data-target="#ModalHapus<?= $data['id_user'] ?>">Hapus</a>

                                    <!-- Modal Delete-->
                                    <form action="<?= base_url('admin/delete_user') ?>" method="post">
                                        <div class="modal" id="ModalHapus<?= $data['id_user'] ?>" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content bg-ligh">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus User</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>" class="form-control" required>
                                                        <p class="text-left">Anda yakin ingin menghapus user?</p>
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
        var list_user = $('#list_user').DataTable( {
            "columnDefs": [ {
                'targets': 'no-sort',
                'searchable': false,
                'orderable': false
            } ],
            "order": [ 1, 'asc' ]
        } );

        list_user.on( 'order.dt search.dt', function () {
            list_user.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    });
</script>