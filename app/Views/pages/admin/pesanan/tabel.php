<thead>
    <tr>
        <th style="width: 5%">#</th>
        <th>konsumen</th>
        <th>produk</th>
        <th>tanggal</th>
        <th>status</th>
        <th>aksi</th>
    </tr>
</thead>
<tbody>
    <?php
    $i = 1;
    foreach ($pesanan as $Pesanan) :
    ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $Pesanan['nama'] ?></td>
            <td><?= $Pesanan['merek'] . '-' . $Pesanan['model'] ?></td>
            <td><?= explode(" ", $Pesanan['tanggal'])[0] ?></td>
            <td><span class="badge badge-<?= ($Pesanan['status'] == 'pending') ? 'warning' : 'success' ?>"><?= $Pesanan['status'] ?></span></td>
            <td>
                <button type="button" class="btn btn-primary btn-sm" onclick="invoice(<?= $Pesanan['id'] ?>)">
                    <i class="fas fa-eye"></i> Detail
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>