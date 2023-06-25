<?= $this->extend('template/user'); ?>
<?= $this->section('content'); ?>
<section class="product_section layout_padding container">
    <div class="container">
        <h1>Rekomendasi Produk</h1>
        <div class="row">
            <?php foreach ($Produk as $produk) : ?>
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div class="img-box">
                            <img src="dist2/images/P-<?= $produk['jenis'] ?>.jpg" alt="">
                            <a href="/produk/<?= $produk['id'] ?>" class="add_cart_btn">
                                <span>
                                    Pesan
                                </span>
                            </a>
                        </div>
                        <div class="detail-box">
                            <p><?= $produk['jenis'] ?></p>
                            <h5>
                                <?= $produk['merek'] ?> <?= strtoupper($produk['model']) ?>
                            </h5>
                            <div class="product_info">
                                <h5>
                                    <span>Rp</span> <?= number_format($produk['harga']) ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <button class="btn btn-primary d-block" id="btn-show" onclick="show()">Tampilkan Perhitungan</button>
        <button class="btn btn-primary d-none" id="btn-hide" onclick="hide()">Sembunyikan Perhitungan</button>

        <div class="codebox d-none" id="console">
            <code>
                TAHAP 1 : menetukan kriteria yang digunakan
                <table>
                    <th>
                        <tr>
                            <td>No</td>
                            <td>Kriteria</td>
                        </tr>
                    </th>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($kriteria as $Kriteria) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $Kriteria['nama'] ?></td>
                            </tr>
                        <?php endforeach; ?>
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
                        <?php $i = 1 ?>
                        <?php foreach ($kriteria as $Kriteria) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $Kriteria['nama'] ?></td>
                                <td><?= $Kriteria['bobot'] ?></td>
                                <td><?= $Kriteria['normalisasi'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                TAHAP 3 : Hitung Nilai Utility
                Tabel Data Alternatif
                <table>
                    <th>
                        <tr>
                            <td>No</td>
                            <td>Model</td>
                            <?php foreach ($kriteria as $Kriteria) : ?>
                                <td><?= $Kriteria['nama'] ?></td>
                            <?php endforeach; ?>
                        </tr>
                    </th>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($utility as $Utility) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $Utility['model'] ?></td>
                                <?php foreach ($kriteria as $Kriteria) : ?>
                                    <td><?= $Utility[$Kriteria['nama']] ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                Tabel Nilai Utility
                <table>
                    <th>
                        <tr>
                            <td>No</td>
                            <td>Model</td>
                            <?php foreach ($kriteria as $Kriteria) : ?>
                                <td><?= 'Utility ' . $Kriteria['nama'] ?></td>
                            <?php endforeach; ?>
                        </tr>
                    </th>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($utility as $Utility) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $Utility['model'] ?></td>
                                <?php foreach ($kriteria as $Kriteria) : ?>
                                    <td><?= number_format($Utility['utility_' . $Kriteria['nama']], 4) ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                TAHAP 4 : Hitung Nilai Akhir
                <table>
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Model</td>
                            <td>Nilai Akhir</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($nilaiAkhirSort as $NilaiAkhirSort) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $NilaiAkhirSort['model'] ?></td>
                                <td><?= $NilaiAkhirSort['nilai_akhir'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </code>
        </div>
</section>
<?= $this->endsection('content'); ?>

<?= $this->section('style'); ?>
<style>
    .codebox {
        /* Below are styles for the codebox (not the code itself) */
        border: 1px solid black;
        background-color: #EEEEFF;
        /* width: 300px; */
        overflow: auto;
        padding: 10px;
    }

    .codebox code {
        /* Styles in here affect the text of the codebox */
        font-size: 0.9em;
        /* You could also put all sorts of styling here, like different font, color, underline, etc. for the code. */
        /* color: #EEEEFF; */
    }

    td {
        border: 1px solid;
        padding: 3px;
        text-align: center;
    }

    table {
        margin-bottom: 1rem;
    }

    #console {
        font-family: 'Courier New', Courier, monospace;
    }
</style>
<?= $this->endsection('style'); ?>

<?= $this->section('script'); ?>
<script>
    function show() {
        var codeBox = document.getElementById('console')
        var btnShow = document.getElementById('btn-show')
        var btnHide = document.getElementById('btn-hide')

        codeBox.classList.remove('d-none')
        codeBox.classList.add('d-block')

        btnShow.classList.remove('d-block')
        btnShow.classList.add('d-none')

        btnHide.classList.remove('d-none')
        btnHide.classList.add('d-block')
    }

    function hide() {
        var codeBox = document.getElementById('console')
        var btnShow = document.getElementById('btn-show')
        var btnHide = document.getElementById('btn-hide')


        codeBox.classList.remove('d-block')
        codeBox.classList.add('d-none')

        btnHide.classList.remove('d-block')
        btnHide.classList.add('d-none')

        btnShow.classList.remove('d-none')
        btnShow.classList.add('d-block')
    }
</script>
<?= $this->endsection('script'); ?>