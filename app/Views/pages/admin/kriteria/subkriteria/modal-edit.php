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
                <?= form_open('admin/kriteria/update_subkriteria', ['class' => 'form-edit']); ?>
                <?= csrf_field(); ?>
                <input id="input-fkKriteria" type="text" name="fkKriteria" hidden value="<?= $subkriteria['fkKriteria'] ?>">
                <input id="input-id" type="text" name="id" value="<?= $subkriteria['id']?>" hidden>
                <div class="form-group row">
                    <label for="inputSubkriteria" class="col-sm-3 col-form-label">Subkriteria</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputSubkriteria" placeholder="Masukkan Subkriteria" name="nama" value="<?= $subkriteria['nama'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNilai" class="col-sm-3 col-form-label">Nilai</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="inputNilai" placeholder="Masukkan niia" name="nilai" value="<?= $subkriteria['nilai'] ?>">
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