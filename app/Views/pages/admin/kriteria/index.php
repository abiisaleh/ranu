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
      <button type="button" class="btn btn-sm btn-info float-left" data-toggle="modal" data-target="#modal-default">Tambah Kriteria</button>
      <a id="btn-subkriteria" class="btn btn-sm btn-success float-right">Subkriteria</a>
    </div>
    <!-- card footer  -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->

<!-- modal kriteria -->
<div class="modal fade" id="modal-default" id="addModal">
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
        <input id="input-fkJenis" type="text" name="fkJenis" hidden>
        <div class="form-group row">
          <label for="inputKriteria" class="col-sm-2 col-form-label">Kriteria</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputKriteria" placeholder="Masukkan Kriteria" name="nama">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputBobot" class="col-sm-2 col-form-label">Bobot</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="inputBobot" placeholder="Masukkan Bobot" name="bobot">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputBobot" class="col-sm-2 col-form-label">Utility</label>
          <div class="custom-control custom-radio pt-2 col-5">
            <input class="custom-control-input" type="radio" id="customRadio1" name="utility" value="lebih kecil lebih baik">
            <label for="customRadio1" class="custom-control-label">lebih kecil lebih baik</label>
          </div>
          <div class="custom-control custom-radio pt-2 col-5">
            <input class="custom-control-input" type="radio" id="customRadio2" name="utility" value="lebih besar lebih baik">
            <label for="customRadio2" class="custom-control-label">lebih besar lebih baik</label>
          </div>
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

<!-- Get Modal -->
<div class="view-modal" style="display: none;"></div>

<?= $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>

<script type="text/javascript">
  // Function get product ajax
  function get_data() {
    id = $('#jenis').val()
    $.ajax({
      url: "<?= base_url('admin/kriteria/get_data') ?>",
      data: {
        id: id
      },
      dataType: "json",
      success: function(response) {
        $('.view-data').html(response.output);
        $('#input-fkJenis').attr("value", id);
        $('#btn-subkriteria').attr("href", "admin/kriteria/subkriteria/" + id);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    })
  }

  //edit
  function edit(id) {
    $.ajax({
      type: "post",
      url: "<?= base_url('admin/kriteria/edit'); ?>",
      data: {
        id: id
      },
      dataType: "json",
      success: function(response) {
        if (response.output) {
          $('.view-modal').html(response.output).show();
          $('#editModal').modal('show');
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  }

  function update() {
    $.ajax({
        type: "post",
        url: $('.form-edit').attr('action'),
        data: $('.form-edit').serialize(),
        dataType: "json",
        beforeSend: function() {
          $('.btn-save').attr('disable', 'disabled');
          $('.btn-save').html('<i class="fas fa-spin fa-spinner"></i>');
        },
        complete: function() {
          $('.btn-save').removeAttr('disable');
          $('.btn-save').html('Save');
        },
        success: function(response) {
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

            $('input').val('')
            $('#editModal').modal('hide');
            get_data()
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
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
    get_data();

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
          $('.btn-save').removeAttr('disable');
          $('.btn-save').html('Save');
        },
        success: function(response) {
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

            $('input').val('')
            $('#addModal').modal('hide');
            get_data()
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