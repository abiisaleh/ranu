<?= $this->extend('template/admin'); ?>
<?= $this->section('style'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<?= $this->endSection('style'); ?>

<?= $this->section('content'); ?>

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
      <table id="produkTabel" class="table table-bordered table-striped view-data">
        <thead>
          <tr>
            <th>No</th>
            <th>Jenis Produk</th>
            <th>Merek</th>
            <th>Model</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr>
        </thead>
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
        <?php foreach ($jenis as $Jenis) : ?>
          <a class="btn btn-outline-primary btn-block" href="admin/produk/form/<?= $Jenis['id'] ?>">Data <?= $Jenis['nama'] ?> Baru</a>
        <?php endforeach; ?>
        <a class="btn btn-primary btn-block" href="admin/produk/jenis/form">Jenis Produk Baru</a>
        <br>
        <!-- Tambah <a href="/admin/produk/form/baru">jenis produk</a> baru -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Page specific script -->
<script>
  function tabelProduk() {
    $("#produkTabel").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["pdf", "print"]
    }).buttons().container().appendTo('#produkTabel_wrapper .col-md-6:eq(0)');
  }

  function get_data() {
    $.ajax({
      url: "<?= base_url('admin/produk/get_data') ?>",
      dataType: "json",
      success: function(response) {
        $('#produkTabel').html(response.output)
        tabelProduk()
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
      }
    })
  }

  //delete
  function deletes(id) {
    Swal.fire({
      title: 'Anda Yakin?',
      text: `Data yang dipilih akan dihapus!`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "post",
          url: "<?= base_url('admin/produk/delete'); ?>",
          data: {
            id: id
          },
          dataType: "json",
          success: function(response) {
            if (response.output) {
              Swal.fire({
                icon: 'success',
                title: 'Deleted',
                text: response.output,
              });
              get_data()
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
          }
        });
      }
    });
  }

  $(document).ready(function() {
    get_data();
  });
</script>
<?= $this->endSection('script'); ?>