<?= $this->extend('template/admin'); ?>

<?= $this->section('style'); ?>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<?= $this->endsection('style'); ?>

<?= $this->section('content'); ?>
<div class="col">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Tabel Kriteria</h3>
      <div class="card-tools">
        <select class="form-control" id="jenis" onchange="get_data()">
          <?php foreach ($jenis as $Jenis) : ?>
            <option value="<?= $Jenis['id'] ?>"><?= $Jenis['nama'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <div class="view-data"></div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
      <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"> -->
      <button type="button" class="btn btn-sm btn-info float-left" data-toggle="modal" data-target="#modal-default">Tambah Kriteria</button>
      <a href="javascript:void(0)" class="btn btn-sm btn-success float-right">Simpan</a>
    </div>
    <!-- card footer  -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Kriteria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open('admin/kriteria/create', ['class' => 'form-add']); ?>
        <?= csrf_field(); ?>
        <input type="text" value="1" name="fkJenis" hidden>
        <div class="form-group row">
          <label for="inputKriteria" class="col-sm-2 col-form-label">Kriteria</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputKriteria" placeholder="Masukkan Kriteria" name="nama">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputBobot" class="col-sm-2 col-form-label">Jenis</label>
          <div class="custom-control custom-radio pt-2 col-5">
            <input class="custom-control-input" type="radio" id="customRadio1" name="jenis">
            <label for="customRadio1" class="custom-control-label">Cost</label>
          </div>
          <div class="custom-control custom-radio pt-2 col-5">
            <input class="custom-control-input" type="radio" id="customRadio2" name="jenis">
            <label for="customRadio2" class="custom-control-label">Benefit</label>
          </div>
        </div>

        <div class="form-group">
          <label>Subkriteria</label>
          <textarea class="form-control" rows="3" placeholder="pertama,kedua,ketiga, ..."></textarea>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary btn-save">Simpan</button>
      </div>
      <?= form_close(); ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>

<script type="text/javascript">
  // Function get product ajax
  function get_data() {
    $.ajax({
      url: "<?= base_url('admin/kriteria/get_data') ?>",
      data: {
        id: $('#jenis').val()
      },
      dataType: "json",
      success: function(response) {
        $('.view-data').html(response.output);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    })
  }

  //delete
  function deletes(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: `You won't be able to revert this!`,
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
          url: "<?= base_url('admin/kriteria/delete'); ?>",
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

  // view output
  $(document).ready(function() {
    //load data by jenis
    get_data($('#jenis').val());

    //add data
    $('.form-add').submit(function(e) {
      e.preventDefault();
      $.ajax({
        type: "post",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",
        beforeSend: function() {
          $('.btn-save').attr('disable', 'disabled');
          $('.btn-save').html('<i class="fas fa-spin fa-spinner"></i>');
        },
        complete: function() {
          // $('.btn-save').removeAttr('disable');
          // $('.btn-save').html('Save');
        },
        success: function(response) {
          console.log('data berhasil');
          jenis($('#jenis').val());
          if (response.error) {
            if (response.error.name) {
              $('#name').addClass('is-invalid');
              $('.errorName').html(response.error.name);
            } else {
              $('#name').removeClass('is-invalid');
              $('.errorName').html('');
            }

            if (response.error.description) {
              $('#description').addClass('is-invalid');
              $('.errorDesc').html(response.error.description);
            } else {
              $('#description').removeClass('is-invalid');
              $('.errorDesc').html('');
            }

            if (response.error.price) {
              $('#price').addClass('is-invalid');
              $('.errorPrice').html(response.error.price);
            } else {
              $('#price').removeClass('is-invalid');
              $('.errorPrice').html('');
            }

            if (response.error.date) {
              $('#date').addClass('is-invalid');
              $('.errorDate').html(response.error.date);
            } else {
              $('#date').removeClass('is-invalid');
              $('.errorDate').html('');
            }

          } else {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: response.success,
              showConfirmButton: false,
              timer: 1800
            })

            $('#addModal').modal('hide');
            jenis($('#jenis').val());
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
    })
  });
</script>
<?= $this->endSection('script'); ?>