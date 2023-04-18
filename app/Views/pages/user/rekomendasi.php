<?= $this->extend('template/user'); ?>
<?= $this->section('content'); ?>
<section class="product_section layout_padding">
    <div class="container" id="console">
        TAHAP 1 : menetukan kriteria yang digunakan
        <table>
            <th>
                <tr>
                    <td>No</td>
                    <td>Kriteria</td>
                </tr>
            </th>
            <tbody>
                <?= $i = 1?>
                <?php foreach ($kriteria as $Kriteria) :?>
                <tr>
                    <td><?= $i++?></td>
                    <td><?= $Kriteria['nama']?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        TAHAP 2 : Menentukan bobot & normalisasi kriteria
        <table>
            <th>
                <tr>
                    <td>No</td>
                    <td>Kriteria</td>
                    <td>Bobot</td>
                    <td>Normalisasi</td>
                </tr>
            </th>
            <tbody>
                <?php foreach ($kriteria as $Kriteria) :?>
                <tr>
                    <td><?= $i++?></td>
                    <td><?= $Kriteria['nama']?></td>
                    <td><?= $Kriteria['bobot']?></td>
                    <td>0</td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        TAHAP 3 : Hitung Nilai Utility
        Tabel Data Alternatif
        <table>
            <th>
                <tr>
                    <td>No</td>
                    <td>Model</td>
                    <?php foreach ($kriteria as $Kriteria) :?>
                        <td><?= $Kriteria['nama']?></td>
                    <?php endforeach;?>
                </tr>
            </th>
            <tbody>
                <?= $i = 0?>
                <?php foreach ($utility as $Utility) :?>
                <tr>
                    <td><?= $i++?></td>
                    <td><?= $Utility['model']?></td>
                    <?php foreach ($kriteria as $Kriteria) :?>
                        <td><?= $Utility[$Kriteria['nama']]?></td>
                    <?php endforeach;?>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        Tabel Nilai Utility
        <table>
            <th>
                <tr>
                    <td>No</td>
                    <td>Model</td>
                    <?php 
                        foreach ($kriteria as $Kriteria) :
                            if (!in_array($Kriteria['nama'], ["Fungsi","Ukuran","Merek"])) :
                    ?>
                        <td><?= 'Utility '.$Kriteria['nama']?></td>
                    <?php
                            endif; 
                        endforeach;
                    ?>
                </tr>
            </th>
            <tbody>
                <?= $i = 0?>
                <?php foreach ($utility as $Utility) :?>
                <tr>
                    <td><?= $i++?></td>
                    <td><?= $Utility['model']?></td>
                    <?php 
                        foreach ($kriteria as $Kriteria) :
                            if (!in_array($Kriteria['nama'],["Fungsi","Ukuran","Merek"])) :
                    ?>
                        <td><?= number_format($Utility['utility_'.$Kriteria['nama']],4)?></td>
                    <?php
                            endif; 
                        endforeach;
                    ?>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        TAHAP 4 : Hitung Nilai Akhir

        ====Hasil====
    </div>
</section>
<?= $this->endsection('content'); ?>

<?= $this->section('style');?>
<style>
    td {
        border: 1px solid;
        padding: 3px;
        text-align: center;
    }

    #console {
        font-family: 'Courier New', Courier, monospace;
    }
</style>
<?= $this->endsection('style');?>