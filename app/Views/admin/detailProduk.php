<?= $this->extend('layout/template'); ?>

<?= $this->section('produk'); ?>
<div class="container-fluid">
    <div class="row">

        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800">Detail Produk</h1>
        </div>

        <div class="row">
            <div class="rounded col produk d-flex flex-column align-items-center border border-secondary pt-2 pb-2 mb-2 bg-primary">
                <div class="rounded">
                    <div class="mb-2"><img style="min-width:150px; max-width: 500px;" src="/img/<?= $produk['img']; ?>" alt="img"></div>
                </div>
                <div class="rounded col d-flex flex-column align-items-center bg-light p-2 text-dark">
                    <div class="col d-flex justify-content-start align-items-start">
                        <div class="col-3 bg-danger">
                            <h2>Nama</h2>
                        </div>
                        <div class="col-1 bg-warning d-flex justify-content-center">
                            <h2>:</h2>
                        </div>
                        <div class="col-8 bg-danger">
                            <!-- <h2><?= $produk['nama']; ?></h2> -->
                            <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa saepe minima id culpa blanditiis ab quasi quam ex voluptate, maxime necessitatibus iure alias consectetur asperiores repellat commodi, earum rem deserunt?</h2>
                        </div>
                    </div>

                    <div class="col d-flex justify-content-start align-items-start">
                        <div class="col-3 bg-danger">
                            <h2>Kategori</h2>
                        </div>
                        <div class="col-1 bg-warning d-flex justify-content-center">
                            <h2>:</h2>
                        </div>
                        <div class="col-8 bg-danger">
                            <h2><?= ($produk['kategori'] == 1) ? "Jasa" : "Barang"; ?></h2>
                        </div>
                    </div>

                    <div class="col d-flex justify-content-start align-items-start">
                        <div class="col-3 bg-danger">
                            <h2>Harga</h2>
                        </div>
                        <div class="col-1 bg-warning d-flex justify-content-center">
                            <h2>:</h2>
                        </div>
                        <div class="col-8 bg-danger">
                            <h2>Rp<?= number_format($produk['harga'], 0, '', '.'); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>