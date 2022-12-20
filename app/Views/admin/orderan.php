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
                <a href="/orderan/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa-solid fa-plus"></i> Add Orderan</a>
            </div>
        </div>

        <div class="row">
            <div class="col produk">
                <?php if ($orderan == null) { ?>
                    <div>
                        <h1>Data Kosong</h1>
                    </div>
                <?php } else { ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal Pesan</th>
                                <th scope="col">No Orderan</th>
                                <th scope="col">Nama Pemesan</th>
                                <th scope="col">Nomor Pemesan</th>
                                <th scope="col">Status Pengerjaan</th>
                                <th scope="col">Status Pembayaran</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($orderan as $o) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $o['created_at']; ?></td>
                                    <td><?= $o['no_orderan']; ?></td>
                                    <td><?= $o['nama_pemesan']; ?></td>
                                    <td><?= $o['nomor_pemesan']; ?></td>
                                    <td><?= ($o['status_pengerjaan'] == 1) ? "Pengerjaan" : "Selesai"; ?></td>
                                    <td><?php
                                        if ($o['status_pembayaran'] == 1) {
                                            echo 'DP';
                                        } elseif ($o['status_pembayaran'] == 2) {
                                            echo 'Lunas';
                                        } elseif ($o['status_pembayaran'] == 3) {
                                            echo 'Belum Bayar';
                                        } ?></td>
                                    <td>Rp <?= number_format($o['total_harga'], 0, ',', '.'); ?></td>
                                    <td><a class="btn btn-success" href="/orderan/detail/<?= $o['no_orderan']; ?>">Detail</a>
                                        <a class="btn btn-warning" href="/orderan/edit/<?= $o['no_orderan']; ?>"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-info"><i class="fa-solid fa-print"></i></a>
                                        <form action="/orderan/<?= $o['id']; ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin')"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>