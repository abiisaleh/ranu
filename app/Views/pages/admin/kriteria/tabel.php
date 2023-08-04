<table class="table table-striped">
  <thead>
    <tr>
      <th style="width: 10px">#</th>
      <th>Kritera</th>
      <th style="width: 20%">Bobot</th>
      <th>Subkriteria</th>
      <th>Utility</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
    foreach ($kriteria as $Kriteria) :
    ?>
      <tr>
        <td><?= $i++ ?></td>
        <td><?= $Kriteria['nama'] ?></td>
        <td><?= $Kriteria['bobot'] ?></td>
        <td>
          <?php
          foreach ($subkriteria->where('fkKriteria = ' . $Kriteria['id'])->find() as $Subkriteria)
            if ($Subkriteria)
              echo '[' . $Subkriteria['nama'] . '] ';
          ?>
        </td>
        <td>
          <span class="badge badge-<?= ($Kriteria['utility'] == 'lebih kecil lebih baik') ? 'success' : 'warning' ?>"><?= $Kriteria['utility'] ?></span>
        </td>
        <td>
          <button type="button" class="btn btn-warning btn-sm" onclick="edit(<?= $Kriteria['id'] ?>)">
            <i class="fas fa-edit"></i>
          </button>
          <button type="button" class="btn btn-danger btn-sm" onclick="deletes(<?= $Kriteria['id'] ?>)">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>