            <!-- Table row -->
            <div class="row">
              <div class="col-12">
                <p class="text-bold">No Pesanan: <?= $pesanan['id'] ?></p>
              </div>
              <div class="col-6 mb-2">
                <p>Total Pembayaran</p>
                <p class="text-bold">Rp. <?= number_format($pesanan['harga']) ?></p>
              </div>
              <div class="col-6 mb-2">
                <p>Waktu Pembayaran</p>
                <p class="text-bold"><?= $pesanan['tanggal'] ?></p>
              </div>
              <div class="col-6 mb-2">
                <p>Rincian Pengiriman</p>
                <p class="text-sm">
                  <span class="text-bold">
                    <?= $pesanan['nama'] ?><br>
                  </span>
                  <?= $pesanan['telp'] ?><br>
                  <?= $pesanan['alamat'] ?><br>
                </p>
              </div>
              <div class="col-6 mb-2">
                <p>Metode Pembayaran</p>
                <p class="text-sm">Transfer Bank BRI</p>
              </div>

              <div class="col-12 border-top mb-3"></div>

              <h6 class="text-bold col-12">Rincian Pemesanan</h6>
              <div class="col-1">
                <span class="text-sm text-muted">1x</span>
              </div>
              <div class="col-7">
                <p><?= $pesanan['jenis'] . '-' . $pesanan['merek'] . ' ' . $pesanan['model'] ?></p>
              </div>
              <div class="col-4">
                <p>Rp. <?= number_format($pesanan['harga']) ?></p>
              </div>

              <div class="col-12 border-top mb-3"></div>

              <h6 class="text-bold col-12">Status Pengiriman</h6>
              <div class="col-2">
                <span class="text-sm text-muted"><?= $pesanan['tanggal'] ?></span>
              </div>
              <div class="col-7">
                <p>pemesanan berhasil dibuat</p>
              </div>
              <div class="col-2">
                <a href="../../uploads/<?= $pesanan['id'] ?>-nota.jpg">lihat foto</a>
              </div>

              <?php $pesanan['tanggal_diproses'] ?? '' ?>
              <?php if (!$pesanan['tanggal_diproses'] == '') : ?>
                <div class="col-2">
                  <span class="text-sm text-muted"><?= $pesanan['tanggal_diproses'] ?></span>
                </div>
                <div class="col-7">
                  <p>pemesanan telah diverifikasi & sedang dikirim</p>
                </div>
                <div class="col-3"></div>
              <?php endif; ?>

              <?php $pesanan['tanggal_pengiriman'] ?? '' ?>
              <?php if (!$pesanan['tanggal_pengiriman'] == '') : ?>
                <div class="col-2">
                  <span class="text-sm text-muted"><?= $pesanan['tanggal_pengiriman'] ?></span>
                </div>
                <div class="col-7">
                  <p>pemesanan telah sampai</p>
                </div>
                <div class="col-2">
                  <a href="../../uploads/<?= $pesanan['id'] ?>-kirim.jpg">lihat foto</a>
                </div>
              <?php endif; ?>

            </div>
            <!-- /.row -->

            <?php if ($pesanan['status'] == 'dikirim') : ?>
              <!-- <div class="col-12"> -->
              <form method="post" action="admin/pesanan/upload" enctype="multipart/form-data">
                <div class="form-group mt-2">
                  <input type="hidden" name="id" value="<?= $pesanan['id'] ?>">
                  <label for="inputgambar">Foto Pengiriman</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="gambar" class="custom-file-input" id="inputgambar">
                      <label class="custom-file-label" for="inputgambar">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <button type="submit" class="input-group-text">Upload</button>
                    </div>
                  </div>
                </div>
              </form>
              <!-- </div> -->
            <?php endif; ?>

            <div class="col-12 border-top my-3"></div>

            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-12">
                <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>

                <?php if ($pesanan['status'] == 'pending') : ?>
                  <button type="button" class="btn btn-danger float-right" style="margin-right: 5px;">
                    <i class="fas fa-trash"></i> Batal
                  </button>
                  <button type="button" class="btn btn-warning float-right" style="margin-right: 5px;" onclick="kirim(<?= $pesanan['id'] ?>)"><i class="far fa-credit-card"></i>
                    Kirim
                  </button>
                <?php endif; ?>
              </div>
            </div>
            <!-- /.invoice -->