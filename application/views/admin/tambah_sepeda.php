<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Sepeda</h6>
        </div>
        <div class="card-body">
          <form action="" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
            <div class="form-group">
              <label for="kategori">Kategori</label>
              <select class="form-control" name="kategori" id="kategori" required>
                <option value="">Pilih Kategori</option>
                <?php foreach ($kategori as $data): ?>
                  <option value="<?=$data['id_kategori']?>"><?=$data['kategori']?></option>
                <?php endforeach ?>
              </select>
              <div class="invalid-feedback">
                Anda belum mengisi kategori.
              </div>
            </div>
            <div class="form-group">
              <label for="merk">Merk Sepeda</label>
              <input type="text" class="form-control" name="merk" id="merk" placeholder="Merk Sepeda" autocomplete="off" maxlength="128" required>
              <div class="invalid-feedback">
                Anda belum memasukan merk sepeda.
              </div>
            </div>
            <div class="form-group">
              <label for="gambar">Foto Sepeda</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input input-foto form-control" id="gambar" accept=".png, .jpg, .jpeg" name="gambar" required>
                <label class="custom-file-label" for="gambar">Pilih Foto...</label>
              </div>
              <img src="" class="rounded mx-auto d-block img-fluid mt-3" style="max-width: 50vw;" id="preview">
              <div class="invalid-feedback">
                Anda belum memilih foto.
              </div>
            </div>
            <div class="form-group">
              <label for="harga">Harga (Rp)</label>
              <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" name="harga" id="harga" placeholder="Harga Sepeda (Rp)" autocomplete="off" maxlength="20" required>
              <div class="invalid-feedback">
                Anda belum mengisi harga.
              </div>
            </div>
            <div class="form-group">
              <label for="harga">Deskripsi</label>
              <textarea class="form-control deskripsi" name="deskripsi" id="deskripsi" rows="10" required></textarea>
              <div class="invalid-feedback">
                Anda belum mengisi deskripsi.
              </div>
            </div>
            <div class="form-group">
              <label for="harga">Spesifikasi</label>
              <textarea class="form-control" name="spesifikasi" id="spesifikasi" rows="10" required></textarea>
              <div class="invalid-feedback">
                Anda belum mengisi spesifikasi.
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-lg btn-primary text-center px-5 py-2" name="tambah">Tambah</button>
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