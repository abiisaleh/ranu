<!-- modal edit subkriteria -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Subkriteria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/kriteria/create', ['class' => 'form-edit']); ?>
                <?= csrf_field(); ?>
                <input id="input-fkJenis" type="text" name="fkJenis" hidden value="<?= $kriteria['fkJenis']?>">
                <input id="input-fkJenis" type="text" name="id" hidden value="<?= $kriteria['id']?>">
        <div class="form-group row">
          <label for="inputKriteria" class="col-sm-2 col-form-label">Kriteria</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputKriteria" placeholder="Masukkan Kriteria" name="nama" value="<?= $kriteria['nama']?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputBobot" class="col-sm-2 col-form-label">Bobot</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="inputBobot" placeholder="Masukkan Bobot" name="bobot" value="<?= $kriteria['bobot']?>">
          </div>
        </div>
          <div class="form-group row">
            <label for="inputUtility" class="col-sm-2 col-form-label">Utility</label>
            <div class="col-sm-10">
              <select class="form-control" id="selectUtility" name="utility">
                <option value="lebih kecil lebih baik">lebih kecil lebih baik</option>
                <option value="lebih besar lebih baik">lebih besar lebih baik</option>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary btn-save" onclick="update()">Update</button>
      </div>
            <?= form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
