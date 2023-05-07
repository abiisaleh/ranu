<?= $this->extend('template/admin'); ?>

<?= $this->section('style'); ?>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<?= $this->endsection('style'); ?>

<?= $this->section('content'); ?>
<div class="col">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Tabel Subkriteria <?= $jenis ?></h3>
      <div class="card-tools">
        <select class="form-control" id="kriteria" onchange="get_data()">
          <?php foreach ($kriteria as $Kriteria) : ?>
            <option value="<?= $Kriteria['id'] ?>"><?= $Kriteria['nama'] ?></option>
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
      <button type="button" class="btn btn-sm btn-info float-left" data-toggle="modal" data-target="#addModal">Tambah Subkriteria</button>
    </div>
    <!-- card footer  -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->

<!-- modal add subkriteria -->
<div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Subkriteria <?= $jenis ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open('admin/kriteria/create_subkriteria', ['class' => 'form-add']); ?>
        <?= csrf_field(); ?>
        <input id="input-fkKriteria" type="text" name="fkKriteria" hidden>
        <div class="form-group row">
          <label for="inputSubkriteria" class="col-sm-3 col-form-label">Subkriteria</label>
          <div class="col-sm-9">
            <input type="text" class="form-control input-data" id="inputSubkriteria" placeholder="Masukkan Subkriteria" name="nama">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputNilai" class="col-sm-3 col-form-label">Nilai</label>
          <div class="col-sm-9">
            <input type="number" class="form-control input-data" id="inputNilai" placeholder="Masukkan niia" name="nilai">
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
    id = $('#kriteria').val()
    $.ajax({
      url: "<?= base_url('admin/kriteria/get_subkriteria') ?>",
      data: {
        id: id
      },
      dataType: "json",
      success: function(response) {
        $('.view-data').html(response.output);
        $('#input-fkKriteria').attr('value', id);
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
      url: "<?= base_url('admin/kriteria/get_modalEdit'); ?>",
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
          $('.btn-update').attr('disable', 'disabled');
          $('.btn-update').html('<i class="fas fa-spin fa-spinner"></i>');
        },
        complete: function() {
          $('.btn-update').removeAttr('disable');
          $('.btn-update').html('Update');
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

            $('#editModal').modal('hide');
            get_data();
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
      return false;
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
          url: "<?= base_url('admin/kriteria/delete_subkriteria'); ?>",
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
            if (response.error.nama) {
              $('#inputSubkriteria').addClass('is-invalid');
              $('.errorName').html(response.error.nama);
            } else {
              $('#inputSubkriteria').removeClass('is-invalid');
              $('.errorName').html('');
            }

            if (response.error.nilai) {
              $('#inputNilai').addClass('is-invalid');
              $('.errorDesc').html(response.error.nilai);
            } else {
              $('#inputNilai').removeClass('is-invalid');
              $('.errorDesc').html('');
            }

          } else {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: response.success,
              showConfirmButton: false,
              timer: 1800
            })
            $('.input-data').val('');
            $('#addModal').modal('hide');
            get_data();
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
          console.log(xhr.responseText)
        }
      });
      return false;
    })
  });

  $('#navKriteria').addClass('active')
</script>
<?= $this->endSection('script'); ?>