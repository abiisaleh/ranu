<?= $this->extend('template/user');?>
<?= $this->section('content');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h2 class="text-center display-4 p-5">Plaza Elektronik</h2>
            <form action="enhanced-results.html">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!-- rekomendasi -->
                                <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Rekomendasi</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                                <div class="form-group">
                                    <label>Jenis Produk:</label>
                                    <select class="select2" style="width: 100%;">
                                        <?php foreach ($jenis as $Jenis):?>
                                            <option><?= $Jenis['nama']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                
                                <label>Kriteria:</label>
                                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label text-sm">Harga</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label text-sm">Merek</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label text-sm">Daya Listrik</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              <a href="javascript:void(0)" class="btn btn-block btn-primary"><i class="fas fa-search"></i>Cari</a>
              </div>
            </div>
                            </div>
                            <div class="col-sm-6 col-md-8 col-lg-9">
                                <!-- produk -->
                                <div class="row">
                                    <?php foreach ($produk as $Produk):?>
                                    <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card card-primary">
              <div class="card-body">
                <img src="../dist/img/user5-128x128.jpg" class="img-rounded" width="100%">
                <span class="badge bg-danger"><?=$Produk['jenis']?></span><br>                            
                <h6><?=$Produk['merek']?>-<?=$Produk['model']?></h6> 
                <span class="text-bold">Rp. <?= number_format($Produk['harga'])?></span>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-block btn-warning"><i class="fas fa-shopping-cart"></i> Beli</a>
              </div>
              <!-- card footer  -->
            </div>
        </div>
        <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
  </div>
<?= $this->endSection('content');?>