<?= $this->extend('layout/template'); ?>

<?= $this->section('produk'); ?>
<div class="container-fluid">
    <div class="row">

        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800">Produk</h1>
        </div>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('delete')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('delete'); ?>
            </div>
        <?php endif; ?>

        <div class="row mb-2">
            <div class="col-4">
                <a href="/produk/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa-solid fa-plus"></i> Add Produk</a>
            </div>
        </div>

        <div class="row">
            <div class="col produk">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">IMG</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($produk as $p) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><img style="width: 100px; border: 1px solid;" src="/img/<?= $p['img']; ?>" alt="img" class="img_produk"></td>
                                <td><?= $p['nama']; ?></td>
                                <td><?= ($p['kategori'] == 1) ? "Jasa" : "Barang"; ?></td>
                                <td><?= $p['harga']; ?></td>
                                <td><?= $p['deskripsi']; ?></td>
                                <td><a class="btn btn-success" href="/produk/detail/<?= $p['slug']; ?>">Detail</a>
                                    <a class="btn btn-warning" href="/produk/edit/<?= $p['slug']; ?>"><i class="fas fa-edit"></i></a>
                                    <form action="/produk/<?= $p['id']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin')"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>