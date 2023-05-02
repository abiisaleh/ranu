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
                      <td>1</td>
                      <td>Call of Duty</td>
                      <td>455-981-221</td>
                      <td>El snort testosterone trophy driving gloves handsome</td>
                      <td>$64.50</td>
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
                      <td>Muhamad Abi Saleh</td>
                    </tr>
                    <tr>
                      <th>Telp</th>
                      <td>082238204776</td>
                    </tr>
                    <tr>
                      <th>Alamat:</th>
                      <td>Abepura</td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-6">
                <p class="lead">Bukti Pembayaran</p>
                <a href="../../dist/img/credit/visa.png">
                  <img src="../../dist/img/credit/visa.png" alt="Visa" width="200">
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
                <?php else : ?>
                  <button href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-success float-right" onclick="selesai(<?= $pesanan['id'] ?>)"><i class="fas fa-print"></i> Selesai</button>
                <?php endif; ?>

              </div>
            </div>
            </div>
            <!-- /.invoice -->