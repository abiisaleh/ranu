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