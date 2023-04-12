<table id="tabel" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Subkriteria</th>
      <th style="width: 20%">Nilai</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!$subkriteria) : ?>
      <tr>
        <td colspan="3" class="text-center">Data tidak ditemukkan</td>
      </tr>
      <?php
    else :
      foreach ($subkriteria as $Subkriteria) :
      ?>
        <tr>
          <td><?= $Subkriteria['nama'] ?></td>
          <td><?= $Subkriteria['nilai'] ?></td>
          <td>
            <button class="btn btn-warning btn-sm" onclick="edit(<?= $Subkriteria['id']  ?>)">
              <i class="fas fa-edit"></i>
            </button>
            <button type="button" class="btn btn-danger btn-sm" onclick="deletes(<?= $Subkriteria['id'] ?>)">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
    <?php
      endforeach;
    endif;
    ?>
  </tbody>
</table>