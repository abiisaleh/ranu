<table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Kritera</th>
                      <th style="width: 20%">Bobot</th>
                      <th>Subkriteria</th>
                      <th>Jenis</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $i = 0;
                      foreach ($kriteria->kriteriaJenis($Jenis['nama']) as $Kriteria):
                        $i++
                    ?>
                    <tr>
                      <td><?= $i?></td>
                      <td><?= $Kriteria['nama']?></td>
                      <td>
                      <div class="input-group input-group-sm">
                  <span class="input-group-prepend">
                    <button type="button" class="btn btn-danger btn-flat"><i class="fas fa-minus"></i></button>
                  </span>
                    <input type="text" class="form-control col-auto text-center" value="<?= $Kriteria['bobot']?>" disabled>
                  <span class="input-group-append">
                    <button type="button" class="btn btn-warning btn-flat"><i class="fas fa-plus"></i></button>
                  </span>
                </div>
                      </td>
                      <td>murah, mahal</td>
                      <td>
                        <span class="badge badge-success">benefit</span>
                      </td>
                      <td>
                          <button type="button" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                      </button>
                          <button type="button" class="btn btn-danger btn-sm" onclick="deletes(<?= $Kriteria['id'] ?>)">
                            <i class="fas fa-trash"></i>
                      </button>
                      </td>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>