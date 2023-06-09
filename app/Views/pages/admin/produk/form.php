<?= $this->extend('template/admin'); ?>

<?= $this->section('content'); ?>
<div class="col-md-6">
  <!-- general form elements -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Form Produk</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <?= form_open_multipart('/admin/produk/'.$aksi, ['id' => 'produkForm']) ?>    
      <div class="card-body">
        <input type="hidden" value="<?= $jenisID ?>" name="fkJenis">
        <input type="hidden" value="<?= ($produk) ? $produk['id'] : '' ?>" name="id">
        <div class="form-group">
          <label for="inputModel">Model</label>
          <input type="text" class="form-control" id="inputModel" placeholder="masukkan model" name="model" value="<?= (!$produk) ? '' : $produk['model'] ?>">
        </div>
        <?php
        $i = -1;
        foreach ($kriteria as $Kriteria) :
          $i++
        ?>
          <div class="form-group">
            <label for="input<?= $Kriteria['nama'] ?>"><?= $Kriteria['nama'] ?></label>
            <input type="text" class="form-control" id="input<?= $Kriteria['nama'] ?>" placeholder="Masukkan <?= $Kriteria['nama'] ?>" name="<?= strtolower(preg_replace('/\s+/', '_', $Kriteria['nama'])) ?>" value="<?= (!$produk) ? '' : $fitur[$i]['nilai'] ?>">
          </div>
        <?php endforeach; ?>
        <div class="form-group">
          <label for="inputGambar">Gambar</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="inputGambar" name="gambar">
              <label class="custom-file-label" for="inputGambar">Choose file</label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <img id="preview-image" src="#" alt="Preview image" style="display: none;" width="200">
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    <?= form_close() ?>
  </div>
  <!-- /.card -->
</div>
<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
<!-- jquery-validation -->
<script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Page specific script -->
<script>
  $(function() {
    $('#produkForm').validate({
      rules: {
        model: {
          required: true,
        },
        <?php foreach ($kriteria as $Kriteria) : ?>
          <?= strtolower(preg_replace('/\s+/', '_', $Kriteria['nama'])) ?>: {
            required: true,
          },
        <?php endforeach; ?>
      },
      messages: {
        model: {
          required: "model belum diisi",
        },
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  $('#navProduk').addClass('active')

  $(document).ready(function() {
  $('#inputGambar').change(function() {
    var file = $(this)[0].files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#preview-image').attr('src', e.target.result).show();
    };
    reader.readAsDataURL(file);
  });
})
</script>
<?= $this->endSection('script'); ?>