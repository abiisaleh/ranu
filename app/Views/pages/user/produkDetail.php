<?= $this->extend('template/user'); ?>
<?= $this->section('content'); ?>
<section class="product_section layout_padding">
  <div class="container">
    <h1 class="mb-3">Detail Produk</h1>
    <div class="row">
      <div class="col-md-6">
        <img src="dist2/images/P-<?= $produk['nama'] ?>.jpg" alt="Product Image" class="img-fluid">
      </div>
      <div class="col-md-6">
        <h2><?= $produk['merek'] ?> <?= strtoupper($produk['model']) ?></h2>
        <hr>
        <h3>Kriteria</h3>
        <ul>
          <?php foreach ($fitur as $Fitur) : ?>
            <li><?= $Fitur['nama'] ?>:
              <?= ($Fitur['nama'] == 'Harga') ? 'Rp. ' . number_format($Fitur['nilai']) : $Fitur['nilai'] ?>
              <?= ($Fitur['nama'] == 'Tenaga') ? 'PK' : '' ?>
              <?= ($Fitur['nama'] == 'DayaListrik') ? 'watt' : '' ?>
            </li>
          <?php endforeach; ?>
        </ul>
        <hr>
        <p class="lead">Harga: <span class="font-weight-bold">Rp. <?= number_format($produk['harga']) ?></span></p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start btn_box">
          <btn class="view_more-link mr-2" data-toggle="modal" data-target="#pesanModal">Pesan Sekarang</btn>
          <a class="btn btn-outline-secondary" href="javascript:window.history.back();" style="padding: 10px 15px">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal pencarian -->
<div class="modal fade" id="pesanModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="searchModalLabel">Form Pemesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open('/pesan') ?>
        <?= csrf_field(); ?>
        <input type="text" hidden value="<?= $produk['id'] ?>" name="fkProduk">
        <div class="form-group">
          <label for="nama">Nama Lengkap</label>
          <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
          <label for="telepon">Nomor Telepon</label>
          <input type="tel" class="form-control" id="telepon" name="telp" required>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning text-white">Pesan</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>

<?= $this->endsection('content'); ?>

<?= $this->section('script'); ?>
<?= $this->endsection('script'); ?>