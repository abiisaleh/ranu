<?= $this->extend('template/user'); ?>
<?= $this->section('content'); ?>
  <section class="product_section layout_padding">
    <div class="container">
      <h1>Detail Produk</h1>
    <div class="row">
    <div class="col-md-6">
      <img src="https://via.placeholder.com/500x400.png" alt="Product Image" class="img-fluid">
    </div>
    <div class="col-md-6">
      <h2><?= $produk['merek']?> <?= strtoupper($produk['model'])?></h2>
      <p class="lead">Product Description</p>
      <hr>
      <h3>Kriteria</h3>
      <ul>
        <li>Detail 1</li>
        <li>Detail 2</li>
        <li>Detail 3</li>
      </ul>
      <hr>
      <p class="lead">Harga: <span class="font-weight-bold">Rp. <?= number_format($produk['harga'])?></span></p>
      <div class="d-grid gap-2 d-md-flex justify-content-md-start btn_box">
        <a class="view_more-link mr-2" href="#formPesanan">Pesan Sekarang</a>
        <a class="btn btn-outline-secondary" href="javascript:window.history.back();" style="padding: 10px 15px">Kembali</a>
      </div>
    </div>
  </div>
    </div>
  </section>

  <section class="container my-5" id="formPesanan">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <h2>Form Pemesanan</h2>
      <?= form_open('pesan', ['class' => 'form-pesan']); ?>
      <?= csrf_field(); ?>
        <input type="text" hidden value="<?= $produk['id']?>" name="fkProduk">
        <div class="form-group">
          <label for="nama">Nama Lengkap</label>
          <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
          <label for="email">Tanggal Lahir</label>
          <input type="date" class="form-control" id="email" name="tanggalLahir" required>
        </div>
        <div class="form-group">
          <label for="telepon">Nomor Telepon</label>
          <input type="tel" class="form-control" id="telepon" name="telp" required>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Pesan</button>
      <?= form_close(); ?>
    </div>
  </div>
</section>

<?= $this->endsection('content'); ?>

<?= $this->section('script'); ?>
<script>
  $(document).ready(function() {
    //add data
    $('.form-pesan').submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: "post",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",
        beforeSend: function() {
          $('.btn-save').attr('disable', 'disabled');
          $('.btn-save').html('<i class="fas fa-spin fa-spinner"></i>');
        },
        complete: function() {
          $('.btn-save').removeAttr('disable');
          $('.btn-save').html('Save');
        },
        success: function(response) {
          if (response.error) {
            if (response.error.nama) {
              $('#inputSubkriteria').addClass('is-invalid');
              $('.errorName').html(response.error.nama);
            } else {
              $('#inputSubkriteria').removeClass('is-invalid');
              $('.errorName').html('');
            }

            if (response.error.nilai) {
              $('#inputNilai').addClass('is-invalid');
              $('.errorDesc').html(response.error.nilai);
            } else {
              $('#inputNilai').removeClass('is-invalid');
              $('.errorDesc').html('');
            }

          } else {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: response.success,
              showConfirmButton: false,
              timer: 1800
            })
            console.log('berhasil')
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
          console.log(xhr.responseText)
        }
      });
      return false;
    })
  });
</script>
<?= $this->endsection('script'); ?>
