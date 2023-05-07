          <?php foreach ($kriteria as $Kriteria) :?>
          <div class="form-group col-6">
            <label for="<?= $Kriteria['nama']?>Select"><?= $Kriteria['nama']?></label>
            <select class="form-control" name="<?= $Kriteria['nama']?>">
                <option>-</option>
                <?php 
                  $subkriteria = model('subkriteriaModel')->where('fkKriteria',$Kriteria['id'])->find();

                  foreach ($subkriteria as $Subkriteria) :
                ?>
                <option><?= $Subkriteria['nama']?></option>
                <?php endforeach;?>
            </select>
          </div>
          <?php endforeach;?>