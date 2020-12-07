<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
        </div>
        <div class="card-body">
            <form action="" method="post" class="needs-validation" novalidate>
                <input type="hidden" name="id_user" value="<?= $user['id_user']?>">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" autocomplete="off" maxlength="64" required value="<?= $user['nama_lengkap']?>">
                    <div class="invalid-feedback">
                        Anda belum memasukan nama lengkap.
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" maxlength="64" required value="<?= $user['email']?>">
                    <div class="invalid-feedback">
                        Format email salah.
                    </div>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="mb-1 form-control" name="password" id="password" placeholder="Masukan password (6 sampai 16 karakter)" autocomplete="off">
                  <div id="password_visible" style="display: none;">
                    <input class="mr-1" type="checkbox" onclick="password_visibility()">Lihat Password
                  </div>
                  <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti password.</small>
                  <div class="invalid-feedback">
                    Format password salah.
                  </div>
                </div>
                <div class="form-group">
                  <label for="no_tlp">No. Telepon</label>
                  <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" name="no_tlp" id="no_tlp" placeholder="Nomor Telepon" autocomplete="off" maxlength="20" required value="<?= $user['no_tlp']?>">
                  <div class="invalid-feedback">
                    Anda belum mengisi nomor telepon.
                  </div>
                </div>
                <div class="form-group">
                  <label for="jk">Jenis Kelamin</label>
                  <select class="form-control" name="jk" id="jk" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki laki" <?php if($user['jk'] === "Laki laki"){?>selected="selected"<?php } ?>>Laki laki</option>
                    <option value="Perempuan" <?php if($user['jk'] === "Perempuan"){?>selected="selected"<?php } ?>>Perempuan</option>
                </select>
                <div class="invalid-feedback">
                    Anda belum mengisi jenis kelamin.
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-primary text-center px-5 py-2" name="edit">Edit</button>
            </div>
        </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    $( document ).ready(function() {
        $('#password').on('input', edit_password_field);

        function edit_password_field(){
            var password_value = $(this).val();
            $(this).attr('minlength', '6');
            $(this).attr('maxlength', '16');
            $(this).attr('required', 'required');
            $('#password_visible').attr('style', 'display:inline-block;');
            if(password_value.length == 0){
                $(this).removeAttr("minlength");
                $(this).removeAttr("maxlength");
                $(this).removeAttr("required");
                $('#password_visible').attr('style', 'display:none;');
            }
        }
    });
</script>

<script>
    function password_visibility() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>