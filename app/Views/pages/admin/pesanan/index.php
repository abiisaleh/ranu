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
      <h3 class="card-title">Tabel Pesanan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="tabel" class="table table-bordered table-striped view-data">
        <thead>
          <tr>
            <th>#</th>
            <th>konsumen</th>
            <th>produk</th>
            <th>tanggal</th>
            <th>status</th>
            <th>aksi</th>
          </tr>
        </thead>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->

<div class="modal fade" id="modal-pesanan">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Nota Pesanan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="invoiceModal"></div>
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
  function tabel() {
    var dataTable = $("#tabel").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["pdf", "print"],
      "order": [
        [3, 'desc']
      ],
    })

    dataTable.buttons().container().appendTo('#tabel_wrapper .col-md-6:eq(0)')

    dataTable.on('order.dt search.dt', function() {
      let i = 1;

      dataTable.cells(null, 0, {
        search: 'applied',
        order: 'applied'
      }).every(function(cell) {
        this.data(i++);
      });
    }).draw();;
  }

  function get_data() {
    $.ajax({
      url: "<?= base_url('admin/pesanan/get_data') ?>",
      dataType: "json",
      success: function(response) {
        $('#tabel').html(response.output)
        tabel()
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
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "post",
          url: "<?= base_url('admin/pesanan/delete'); ?>",
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
              get_data();
            }
          },
          error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
          }
        });
      }
    });
  }

  function invoice(id) {
    $.ajax({
      type: "post",
      url: "<?= base_url('admin/pesanan/invoice') ?>",
      data: {
        id: id
      },
      dataType: "json",
      success: function(response) {
        $('#invoiceModal').html(response.output)
        $('#modal-pesanan').modal('show')
        bsCustomFileInput.init()
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
      }
    })
  }

  function kirim(id) {
    $.ajax({
      type: "post",
      url: "<?= base_url('admin/pesanan/verifikasi') ?>",
      data: {
        id: id,
        status: 'dikirim'
      },
      success: function() {
        $('#modal-pesanan').modal('hide')
        get_data()
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
      }
    })
  }

  function selesai(id) {
    $.ajax({
      type: "post",
      url: "<?= base_url('admin/pesanan/verifikasi') ?>",
      data: {
        id: id,
        status: 'selesai'
      },
      success: function() {
        $('#modal-pesanan').modal('hide')
        get_data()
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
      }
    })
  }

  $(document).ready(function() {
    get_data();
  });
</script>
<?= $this->endSection('script'); ?>