<?= $this->extend('template/admin'); ?>
<?= $this->section('style'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css">
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
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="col-md-4">
                        <label for="inputnama">Awal Tanggal</label>
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="text" id="min" name="min" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-md-4">
                        <label for="inputnama">Akhir Tanggal</label>
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="text" id="max" name="max" class="form-control">
                    </div>
                </div>
            </div>
            <table id="tabel" class="table table-bordered table-striped view-data">
                <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th>konsumen</th>
                        <th>produk</th>
                        <th>tanggal</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pesanan as $Pesanan) : ?>
                        <tr>
                            <td><?= $Pesanan['id'] ?></td>
                            <td><?= $Pesanan['nama'] ?></td>
                            <td><?= $Pesanan['merek'] . '-' . $Pesanan['model'] ?></td>
                            <td><?= explode(" ", $Pesanan['tanggal'])[0] ?></td>
                            <td><span class="badge badge-<?= ($Pesanan['status'] == 'pending') ? 'warning' : 'success' ?>"><?= $Pesanan['status'] ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<!-- DataTable -->
<script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

<!-- DataTables & Plugins -->
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
    var dataTable = $("#tabel").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "dom": 'Bfrtip',
        "buttons": ["pdf", "print"],
        "columnDefs": [{
            searchable: false,
            orderable: false,
            targets: 0,
        }],
        "order": [
            [3, 'desc']
        ]
    })

    dataTable.on('order.dt search.dt', function() {
        let i = 1;

        dataTable.cells(null, 0, {
            search: 'applied',
            order: 'applied'
        }).every(function(cell) {
            this.data(i++);
        });
    }).draw();

    dataTable.buttons().container().appendTo('#tabel_wrapper .col-md-6:eq(0)');

    //filter by date
    var minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date(data[3]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        }
    );

    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'DD MMMM YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'DD MMMM YYYY'
    });

    // Refilter the table
    $('#min, #max').on('change', function() {
        dataTable.draw();
    });
</script>
<?= $this->endSection('script'); ?>