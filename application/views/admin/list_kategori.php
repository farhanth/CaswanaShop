<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="mt-2 font-weight-bold text-primary float-left">List Kategori</h6>
            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#ModalTambahKategori">
                <i class="fas fa-fw fa-plus mr-2"></i>Tambah Kategori
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php if ($this->session->userdata('pesan') == 'ditambah') : ?>
                    <div class="alert alert-success mb-3" role="alert">
                        Kategori berhasil ditambah.
                    </div>
                <?php elseif ($this->session->userdata('pesan') == 'dihapus') : ?>
                    <div class="alert alert-success mb-3" role="alert">
                        Kategori berhasil dihapus.
                    </div>
                <?php elseif ($this->session->userdata('pesan') == 'diubah') : ?>
                    <div class="alert alert-success mb-3" role="alert">
                        Kategori berhasil diedit.
                    </div>
                <?php endif ?>
                <table class="table table-bordered" id="list_kategori" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Kategori</th>
                            <th class="text-center">Jumlah Barang</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kategori as $data):
                            $this->db->where('id_kategori', $data['id_kategori']);
                            $this->db->from('sepeda');
                            $jumlah_barang = $this->db->count_all_results();
                        ?>
                        <tr>
                            <td class="text-center"></td>
                            <td>
                                <a target="_blank" href="<?=base_url('?kategori='.$data['kategori'])?>"><?= $data['kategori'] ?></a>
                            </td>
                            <td><?= $jumlah_barang ?></td>
                            <td>
                                <div class=text-center>
                                    <a href="#" class="edit_record btn btn-info btn-xs" data-toggle="modal" data-target="#ModalEdit<?= $data['id_kategori'] ?>">Edit</a>
                                    
                                    <a href="#" class="hapus_record btn btn-danger btn-xs" data-toggle="modal" data-target="#ModalHapus<?= $data['id_kategori'] ?>">Hapus</a>

                                    <!-- Modal Edit-->
                                    <form action="<?= base_url('admin/edit_kategori') ?>" method="post" class="needs-validation" novalidate>
                                        <div class="modal" id="ModalEdit<?= $data['id_kategori'] ?>" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content bg-ligh">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus User</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_kategori" value="<?= $data['id_kategori'] ?>" class="form-control" required>
                                                        <input type="text" name="edit_nama_kategori" value="<?= $data['kategori'] ?>" class="form-control" placeholder="Masukan nama kategori.." maxlength="64" required>
                                                        <div class="invalid-feedback">
                                                            Anda belum memasukan nama kategori.
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Edit</button>
                                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Modal Edit End-->
                                    
                                    <!-- Modal Delete-->
                                    <form action="<?= base_url('admin/delete_kategori') ?>" method="post">
                                        <div class="modal" id="ModalHapus<?= $data['id_kategori'] ?>" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content bg-ligh">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus User</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_kategori" value="<?= $data['id_kategori'] ?>" class="form-control" required>
                                                        <p class="text-left">Anda yakin ingin menghapus kategori? Menghapus kategori akan mempengaruhi data produk didalam kategori terkait</p>
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

<!-- Modal Tambah Kategori-->
<form action="" method="post" class="needs-validation" novalidate>
    <div class="modal" id="ModalTambahKategori" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-ligh">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" placeholder="Masukan nama kategori.." maxlength="64" autocomplete="off" required>
                    <div class="invalid-feedback">
                        Anda belum memasukan nama kategori.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="tambah">Tambah</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Modal Tambah Kategori End-->

<script>
    $(document).ready(function() {
        var list_kategori = $('#list_kategori').DataTable( {
            "columnDefs": [ {
                'targets': 'no-sort',
                'searchable': false,
                'orderable': false
            } ],
            "order": [ 1, 'asc' ]
        } );

        list_kategori.on( 'order.dt search.dt', function () {
            list_kategori.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    });
</script>