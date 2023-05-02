<?= $this->extend('template/user'); ?>
<?= $this->section('content'); ?>
<!-- slider section -->
<section class="slider_section" id="home">
  <div id="customCarousel1" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container ">
          <div class="row">
            <div class="col-md-6">
              <div class="detail-box">
                <h1>
                  Kulkas
                </h1>
                <p>
                  Temukan kulkas dengan desain modern dan minimalis serta fitur yang sesuai dengan kebutuhan Anda. Kami menawarkan kulkas dengan pintu berbagai jenis dan ukuran yang sesuai kriteria anda.
                </p>
                <a href="">
                  Read More
                </a>
              </div>
            </div>
            <div class="col-md-6">
              <div class="img-box">
                <img src="dist2/images/slider-kulkas.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="container ">
          <div class="row">
            <div class="col-md-6">
              <div class="detail-box">
                <h1>
                  Air Conditioner
                </h1>
                <p>
                  Temukan AC dengan desain modern dan fitur yang sesuai dengan kebutuhan Anda. Dapatkan AC berkualitas dengan harga terjangkau hanya di toko kami.
                </p>
                <a href="">
                  Read More
                </a>
              </div>
            </div>
            <div class="col-md-6">
              <div class="img-box">
                <img src="dist2/images/slider-ac.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="container ">
          <div class="row">
            <div class="col-md-6">
              <div class="detail-box">
                <h1>
                  Mesin Cuci
                </h1>
                <p>
                  Temukan mesin cuci dengan desain modern dan minimalis yang cocok dengan gaya rumah Anda. Dapatkan mesin cuci berkualitas dengan harga terjangkau hanya di toko kami.
                </p>
                <a href="">
                  Read More
                </a>
              </div>
            </div>
            <div class="col-md-6">
              <div class="img-box">
                <img src="dist2/images/slider-mesin-cuci.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel_btn_box" style="bottom: 25px;">
      <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</section>
<!-- end slider section -->
</div>


<!-- product section -->
<section class="product_section layout_padding" id="produk">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Produk
      </h2>
    </div>
    <div class="row">
      <?php foreach ($produk as $Produk) : ?>
        <div class="col-sm-6 col-lg-4">
          <div class="box">
            <div class="img-box">
              <img src="dist2/images/P-<?= $Produk['jenis'] ?>.jpg" alt="">
              <a href="/produk/<?= $Produk['id'] ?>" class="add_cart_btn">
                <span>
                  Pesan
                </span>
              </a>
            </div>
            <div class="detail-box">
              <p><?= $Produk['jenis'] ?></p>
              <h5>
                <?= $Produk['merek'] ?> <?= strtoupper($Produk['model']) ?>
              </h5>
              <div class="product_info">
                <h5>
                  <span>Rp</span> <?= number_format($Produk['harga']) ?>
                </h5>
                <div class="star_container">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="btn_box">
      <button type="button" class="view_more-link" data-toggle="modal" data-target="#searchModal">
        Cari sesuai kriteria
      </button>
    </div>
  </div>
</section>
<!-- end product section -->

<!-- about section -->
<section class="about_section" id="about">
  <div class="container-fluid  ">
    <div class="row">
      <div class="col-md-5 ml-auto">
        <div class="detail-box pr-md-3">
          <div class="heading_container">
            <h2>
              Kami Menyediakan yang Terbaik
            </h2>
          </div>
          <p>
            Temukan produk elektronik berkualitas untuk rumah Anda seperti kulkas, AC, dan mesin cuci dengan berbagai fitur modern dan minimalis yang akan membuat hidup Anda lebih nyaman dan efisien. Dapatkan produk yang cocok dengan kebutuhan Anda dengan harga terjangkau hanya di toko kami. Tidak perlu mencari ke tempat lain, karena kami memiliki semua produk yang Anda butuhkan untuk membuat rumah Anda menjadi lebih modern dan fungsional. Segera kunjungi toko kami dan temukan penawaran terbaik untuk produk elektronik yang Anda inginkan.
          </p>
          <a href="">
            Read More
          </a>
        </div>
      </div>
      <div class="col-md-6 px-0">
        <div class="img-box">
          <img src="dist2/images/about-img.jpg" alt="">
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end about section -->

<!-- why us section -->
<section class="why_us_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Kenapa Memilih Kami
      </h2>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="box ">
          <div class="img-box">
            <img src="dist2/images/w1.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Fast Delivery
            </h5>
            <p>
              variations of passages of Lorem Ipsum available
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box ">
          <div class="img-box">
            <img src="dist2/images/w2.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Free Shiping
            </h5>
            <p>
              variations of passages of Lorem Ipsum available
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box ">
          <div class="img-box">
            <img src="dist2/images/w3.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Best Quality
            </h5>
            <p>
              variations of passages of Lorem Ipsum available
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end why us section -->


<!-- cabang section -->
<section class="client_section layout_padding" id="cabang">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Kunjungi Kami di
      </h2>
    </div>
  </div>
  <div class="client_container ">
    <div id="carouselExample2Controls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container">
            <div class="box">
              <div class="container">
                <div class="row">
                  <!-- Kolom 1 - Peta -->
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Lokasi Kami</h5>
                        <div style="height:400px;width:100%;">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1020267.5624655023!2d139.80692747303317!3d-2.6905199224516325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x686cf58dc86fcbeb%3A0x7bfcdf343c604b40!2sCentral%20Plaza%20Electronic!5e0!3m2!1sid!2sid!4v1680327286539!5m2!1sid!2sid" height="400" width="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Kolom 2 - Informasi Kontak -->
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Kontak Kami</h5>
                        <p><strong>Alamat:</strong> Jl. Raya Jakarta No. 123, Jakarta</p>
                        <p><strong>Email:</strong> info@company.com</p>
                        <p><strong>Telepon:</strong> 021-123456</p>
                        <p><strong>Website:</strong> www.company.com</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="box">
              <div class="container">
                <div class="row">
                  <!-- Kolom 1 - Peta -->
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Lokasi Kami</h5>
                        <div style="height:400px;width:100%;">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1020267.5624655023!2d139.80692747303317!3d-2.6905199224516325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x686cf58dc86fcbeb%3A0x7bfcdf343c604b40!2sCentral%20Plaza%20Electronic!5e0!3m2!1sid!2sid!4v1680327286539!5m2!1sid!2sid" height="400" width="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Kolom 2 - Informasi Kontak -->
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Kontak Kami</h5>
                        <p><strong>Alamat:</strong> Jl. Raya Jakarta No. 123, Jakarta</p>
                        <p><strong>Email:</strong> info@company.com</p>
                        <p><strong>Telepon:</strong> 021-123456</p>
                        <p><strong>Website:</strong> www.company.com</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="box">
              <div class="container">
                <div class="row">
                  <!-- Kolom 1 - Peta -->
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Lokasi Kami</h5>
                        <div style="height:400px;width:100%;">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1020267.5624655023!2d139.80692747303317!3d-2.6905199224516325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x686cf58dc86fcbeb%3A0x7bfcdf343c604b40!2sCentral%20Plaza%20Electronic!5e0!3m2!1sid!2sid!4v1680327286539!5m2!1sid!2sid" height="400" width="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Kolom 2 - Informasi Kontak -->
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Kontak Kami</h5>
                        <p><strong>Alamat:</strong> Jl. Raya Jakarta No. 123, Jakarta</p>
                        <p><strong>Email:</strong> info@company.com</p>
                        <p><strong>Telepon:</strong> 021-123456</p>
                        <p><strong>Website:</strong> www.company.com</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel_btn-box">
        <a class="carousel-control-prev" href="#carouselExample2Controls" role="button" data-slide="prev">
          <span>
            <i class="fa fa-angle-left" aria-hidden="true"></i>
          </span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample2Controls" role="button" data-slide="next">
          <span>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
          </span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</section>
<!-- end client section -->

<!-- Modal -->
<!-- Modal pencarian -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="searchModalLabel">Pencarian <span class="badge badge-dark">SMART</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open('/smart') ?>
        <div class="form-group">
          <label for="categorySelect">Jenis</label>
          <select class="form-control" name="jenis" id="jenisSelect" onchange="kriteria()">
            <option value="">Pilih</option>
            <?php foreach ($jenis as $Jenis) : ?>
              <option value="<?= $Jenis['id'] ?>"><?= $Jenis['nama'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="row" id="kriteria"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning text-white">Cari</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
<?= $this->endsection('content'); ?>

<?php $this->section('script'); ?>
<script>
  function kriteria() {
    $.ajax({
      url: "<?= base_url('kriteria/get_data') ?>",
      dataType: "json",
      data: {
        id: $('#jenisSelect').val()
      },
      success: function(response) {
        $('#kriteria').html(response.output)
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
      }
    })
  }
</script>
<?php $this->endSection('script'); ?>