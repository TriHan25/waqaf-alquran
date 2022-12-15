<?= $this->extend('layout/templateUser'); ?>

<?= $this->section('content'); ?>
<!-- <div class="banner">
    <img class="img-fluid" src="/img/bg1.jpg" alt="">
</div> -->
<!-- <div class="bg-image">
    <div class="text-bg">
        <h1 class="text-center">Waqaf Alquran</h1>
        <h1 class="text-center">Indonesia</h1>
    </div>
</div> -->
<div class=" content container-fluid mt-5 mb-5">

    <div class="col title-produk text-center">
        <h1 id="text-margin"><b>Produk</b></h1>
    </div>
    <div class="col navbar-produk text-center">
        <h5 id="text-margin">Cari Produk</h5>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button id="color-text-navbar" class="btn" type="submit">Search</button>
        </form>
    </div>
    <div id="card-wrapper" class="col">
        <?php foreach ($produk as $p) :; ?>
            <div class="card" style="width: 15rem;">
                <img src="/img/<?= $p['img']; ?>" alt="img" class="card-img-top">
                <div class="card-body text-center">
                    <p class="card-text"><?= $p['nama']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection(); ?>