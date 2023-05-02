<?php $this->extend('template/user'); ?>
<?php $this->section('content'); ?>
<section class="why_us_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Pembayaran
            </h2>
        </div>
        <div class="row">
            <div class="col-6 mx-auto">
                <p class="text-center">
                    Pesanan <b><?= $idPesanan ?></b> berhasil dibuat.
                    Harap Melakukan pembayaran sebesar <b>Rp. <?= number_format($total) ?></b> ke Mandiri No Rek <b>12345678</b> atas nama ranu irianto lappu
                </p>
            </div>
        </div>
        <div class="col-6 mx-auto">
            <?php form_open('upload') ?>
            <input type="file" name="gambar">
            <?php form_close() ?>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">File berhasil diunggah!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    File yang Anda unggah berhasil disimpan di server.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endsection('content'); ?>

<?php $this->section('style'); ?>
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<?php $this->endsection('style'); ?>

<?php $this->section('script'); ?>

<script>
    const inputElement = document.querySelector('input[type="file"]');
    const pond = FilePond.create(inputElement, {
        server: {
            url: '/upload/<?= $idPesanan ?>'
        }
    });

    // Tampilkan modal pesan sukses ketika file berhasil terunggah
    pond.on('processfiles', () => {
        document.getElementById('successModal').style.display = 'block'
        console.log('berhasil');
    });
</script>
<?php $this->endsection('script'); ?>