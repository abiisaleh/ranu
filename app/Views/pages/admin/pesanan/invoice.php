            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Produk</th>
                      <th>Merek</th>
                      <th>Model</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?= $pesanan['id'] ?></td>
                      <td><?= $pesanan['jenis'] ?></td>
                      <td><?= $pesanan['merek'] ?></td>
                      <td><?= $pesanan['model'] ?></td>
                      <td>Rp. <?= number_format($pesanan['harga']) ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-6">
                <p class="lead">Pembeli</p>

                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Nama:</th>
                      <td><?= $pesanan['nama'] ?></td>
                    </tr>
                    <tr>
                      <th>Telp</th>
                      <td><?= $pesanan['telp'] ?></td>
                    </tr>
                    <tr>
                      <th>Alamat:</th>
                      <td><?= $pesanan['alamat'] ?></td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-6">
                <p class="lead">Bukti Pembayaran</p>
                <a href="../../uploads/<?= $pesanan['id'] ?>-nota.jpg">
                  <img src="../../uploads/<?= $pesanan['id'] ?>-nota.jpg" alt="Bukti Pembayaran" width="200">
                </a>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

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
                <?php elseif ($pesanan['status'] == 'dikirim') : ?>
                  <button href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-success float-right" onclick="selesai(<?= $pesanan['id'] ?>)"><i class="fas fa-print"></i> Selesai</button>
                <?php endif; ?>

              </div>
            </div>
            </div>
            <!-- /.invoice -->