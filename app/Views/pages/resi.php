<?= $this->extend('layout/templateUser'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layout/navbar_cek'); ?>
<div class="container">
    <div class="resi">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>no orderan</th>
                    <th>tgl</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach ($produk2 as $p) { ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $p['no_orderan']; ?></td>
                        <td><?= $p['created_at']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?= $pager->links(); ?>
    </div>

    <a class="link-wa" target="_blank" href="https://wa.me/6281293841173?text=Halo%20saya%20ingin%20pesan%0AProduk:%0AJumlah:%0ATotal%20Harga:%0AAlamat:%0ANo%20Telepon:">
        <div id="whatsapp">
            <i class="fa-brands fa-whatsapp fa-lg"></i> Chat Via Whatsapp
        </div>
    </a>
</div>

<?= $this->endSection(); ?>