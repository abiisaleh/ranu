          <?php foreach ($kriteria as $Kriteria) : ?>
            <div class="form-group col-6">
              <label for="<?= $Kriteria['nama'] ?>Select"><?= $Kriteria['nama'] ?></label>
              <select class="form-control" name="<?= $Kriteria['nama'] ?>">
                <option>-</option>
                <?php
                $subkriteria = model('subkriteriaModel')->where('fkKriteria', $Kriteria['id'])->find();

                foreach ($subkriteria as $Subkriteria) :
                ?>
                  <option value="<?= $Subkriteria['nama'] ?>">
                    <?php
                    if ($Kriteria['nama'] == 'DayaListrik')
                      echo  $Subkriteria['nama'] . ' watt';
                    elseif ($Kriteria['nama'] == 'Harga')
                      echo  'Rp. ' . (explode('-', $Subkriteria['nama'])[0]) . ' - Rp. ' . (explode('-', $Subkriteria['nama'])[1]);
                    elseif ($Kriteria['nama'] == 'JenisKulkas')
                      echo  $Subkriteria['nama'] . ' pintu';
                    elseif ($Kriteria['nama'] == 'Tenaga')
                      echo  $Subkriteria['nama'] . ' PK';
                    else
                      echo  $Subkriteria['nama'];
                    ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          <?php endforeach; ?>