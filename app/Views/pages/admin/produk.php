<?= $this->extend('template/admin');?>
<?= $this->section('style');?>
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<?= $this->endSection('style');?>
<?= $this->section('content');?>

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Produk</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                  <i class="fas fa-plus"></i> Tambah Produk
                </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Jenis Produk</th>
                    <th>Merek</th>
                    <th>Model</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $i = 0;
                    foreach ($produk as $Produk):
                      $i++ 
                  ?>
                  <tr>
                        <td><?= $i?></td>
                        <td><?= $Produk['jenis']?></td>
                        <td><?= $Produk['merek']?></td>
                        <td><?= $Produk['model']?></td>
                        <td><?= number_format($Produk['harga'])?></td>
                        <td>
                          <a class="btn btn-warning btn-sm" href="admin/produk/form/<?= $Produk['fkJenis']?>/<?= $Produk['id']?>">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a class="btn btn-danger btn-sm" href="admin/produk/delete/<?= $Produk['id']?>">
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>
                  </tr>
                  <?php endforeach;?>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Produk</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php foreach ($jenis as $Jenis):?>
                  <a class="btn btn-outline-primary btn-block" href="admin/produk/form/<?= $Jenis['id']?>">Data <?= $Jenis['nama']?> Baru</a>
              <?php endforeach;?>
              <br>
              <!-- Tambah <a href="/admin/produk/form/baru">jenis produk</a> baru -->
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
<?= $this->endSection('content');?>

<?= $this->section('script');?>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<?= $this->endSection('script');?>