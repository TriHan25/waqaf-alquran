<?= $this->extend('layout/templateUser'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layout/navbar'); ?>
<!-- <div class="banner">
    <img class="img-fluid" src="/img/bg1.jpg" alt="">
</div> -->
<div class="bg-image">
    <div class="text-bg">
        <h1 class="text-center">Waqaf Alquran</h1>
        <h1 class="text-center">Indonesia</h1>
    </div>
</div>
<div class="container">
    <div id="produk" class="content mt-5 mb-5">

        <div class="col title-produk text-center">
            <h1 id="text-margin"><b>Produk</b></h1>
        </div>
        <!-- <div class="col navbar-produk text-center">
            <h5 id="text-margin">Cari Produk</h5>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button id="color-text-navbar" class="btn" type="submit">Search</button>
            </form>
        </div> -->
        <div id="card-wrapper" class="col">
            <?php foreach ($produk as $p) :; ?>
                <div class="card">
                    <img src="/img/<?= $p['img']; ?>" alt="img" class="card-img-top">
                    <div class="card-body text-center">
                        <p class="card-text"><?= $p['nama']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="kontak" id="kontak">
        <div class="title-kontak text-center">
            <h1><b>Kontak</b></h1>
        </div>
        <div class="content-kontak col-12">
            <div class="telepon col-4">
                <i class="fa-solid fa-phone fa-2xl"></i>
                <h3>Telepon</h3>
                <p>081245671290</p>
            </div>
            <div class="alamat col-4">
                <i class="fa-solid fa-location-dot fa-2xl"></i>
                <h3>Alamat</h3>
                <p>Kp.Gedong, RT.02/RW.20 No.11, Kec.Beji, Kota Depok</p>
            </div>
            <div class="email col-4">
                <i class="fa-solid fa-envelope fa-2xl"></i>
                <h3>Email</h3>
                <p>waqaf@gmail.com</p>
            </div>
        </div>
    </div>

    <div class="maps mb-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.2894644250646!2d106.83946452915163!3d-6.373612066895887!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69edbcb4b5c57d%3A0x4636126602a6fd3d!2sA%26R%20Production!5e0!3m2!1sid!2sid!4v1672567969763!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <a class="link-wa" target="_blank" href="https://wa.me/6281293841173?text=Halo%20saya%20ingin%20pesan%0AProduk:%0AJumlah:%0ATotal%20Harga:%0AAlamat:%0ANo%20Telepon:">
        <div id="whatsapp">
            <i class="fa-brands fa-whatsapp fa-lg"></i> Chat Via Whatsapp
        </div>
    </a>
</div>

<?= $this->endSection(); ?>