<?= $this->extend('template/admin'); ?>

<?= $this->section('content'); ?>
<div class="col-md-6">
  <!-- general form elements -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Buat Jenis Produk Baru</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="<?= base_url('/admin/produk/jenis/create') ?>" method="post">
      <div class="card-body">
        <div class="form-group">
          <label for="inputjenis">Jenis Produk</label>
          <input type="text" class="form-control" id="inputjenis" placeholder="masukkan nama jenis" name="nama">
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Buat</button>
      </div>
    </form>
  </div>
  <!-- /.card -->
</div>
<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
<!-- Page specific script -->
<script>
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