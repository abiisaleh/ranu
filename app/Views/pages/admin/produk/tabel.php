<thead>
  <tr>
    <th>No</th>
    <th>Jenis Produk</th>
    <th>Merek</th>
    <th>Model</th>
    <th>Harga</th>
    <th>Aksi</th>
  </tr>
</thead>
<tbody>
  <?php
  $i = 0;
  foreach ($produk as $Produk) :
    $i++
  ?>
    <tr>
      <td><?= $i ?></td>
      <td><?= $Produk['jenis'] ?></td>
      <td><?= $Produk['merek'] ?></td>
      <td><?= $Produk['model'] ?></td>
      <td><?= number_format($Produk['harga']) ?></td>
      <td>
        <a class="btn btn-warning btn-sm" href="admin/produk/form/<?= $Produk['fkJenis'] ?>/<?= $Produk['id'] ?>">
          <i class="fas fa-edit"></i>
        </a>
        <button type="button" class="btn btn-danger btn-sm" onclick="deletes(<?= $Produk['id'] ?>)">
          <i class="fas fa-trash"></i>
        </button>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>