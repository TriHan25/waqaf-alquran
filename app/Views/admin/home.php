<?= $this->extend('layout/template'); ?>

<?= $this->section('home'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate
            Report</a>
    </div>
    <div class="content-wrap">
        <div class="produk_jum">
            <h2>Total Jumlah Produk</h2>
            <p><?= $produk_jum; ?></p>
        </div>
        <div class="orderan_jum">
            <h2>Total Jumlah Orderan</h2>
            <p><?= $orderan_jum; ?></p>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>