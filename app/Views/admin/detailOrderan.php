<?= $this->extend('layout/template'); ?>

<?= $this->section('produk'); ?>
<div class="container-fluid mb-4">
    <div class="row">

        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800">Detail Orderan</h1>
            <div>
                <a href="/orderan" class="btn btn-danger mr-2">Kembali</a>
                <a class="btn btn-info"><i class="fa-solid fa-print"></i></a>
            </div>
        </div>

        <div class="col-12 detail mb-3">
            <div class="col-xs-12 col-sm-8 d-flex border-bottom">
                <div class="col-4 text-left">No Orderan</div>
                <div class="col-1 text-center">:</div>
                <div class="col-7 "><?= $orderan['no_orderan']; ?></div>
            </div>
            <div class="col-xs-12 col-sm-8 d-flex border-bottom">
                <div class="col-4 text-left">Nama</div>
                <div class="col-1 text-center">:</div>
                <div class="col-7 "><?= $orderan['nama_pemesan']; ?></div>
            </div>
            <div class="col-xs-12 col-sm-8 d-flex border-bottom">
                <div class="col-4 text-left">No Telepon</div>
                <div class="col-1 text-center">:</div>
                <div class="col-7 "><?= $orderan['nomor_pemesan']; ?></div>
            </div>
            <div class="col-xs-12 col-sm-8 d-flex border-bottom">
                <div class="col-4 text-left">Status Kerja</div>
                <div class="col-1 text-center">:</div>
                <?php if ($orderan['status_pengerjaan'] == 1) {; ?>
                    <div class="col-7 ">Pegerjaan</div>
                <?php } elseif ($orderan['status_pengerjaan'] == 2) { ?>
                    <div class="col-7 ">Selesai</div>
                <?php } ?>
            </div>
            <div class="col-xs-12 col-sm-8 d-flex border-bottom">
                <div class="col-4 text-left">Status Bayar</div>
                <div class="col-1 text-center">:</div>
                <?php if ($orderan['status_pembayaran'] == 1) {; ?>
                    <div class="col-7 ">DP</div>
                <?php } elseif ($orderan['status_pembayaran'] == 2) { ?>
                    <div class="col-7 ">Lunas</div>
                <?php } elseif ($orderan['status_pembayaran'] == 3) { ?>
                    <div class="col-7 ">Belum Bayar</div>
                <?php } ?>
            </div>
            <div class="col-xs-12 col-sm-8 d-flex border-bottom">
                <div class="col-4 text-left">Tanggal Pesan</div>
                <div class="col-1 text-center">:</div>
                <div class="col-7 "><?= $orderan['created_at']; ?></div>
            </div>
        </div>


        <div class="col-12 produk">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">IMG</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah beli</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($produk as $p) : ?>
                        <tr class="text-center">
                            <th scope="row"><?= $i++; ?></th>
                            <td><img style="width: 100px; border: 1px solid;" src="/img/<?= $p['img']; ?>" alt="img" class="img_produk"></td>
                            <td><?= $p['nama']; ?></td>
                            <td>Rp <?= number_format($p['harga'], 0, ',', '.'); ?></td>
                            <td><?= $p['jumlah']; ?></td>
                            <td class="text-right">Rp <?= number_format($p['harga'] * $p['jumlah'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"></td>
                        <td class="text-center"><b>Total Harga</b></td>
                        <td class="text-right"><b>Rp <?= number_format($p['total_harga'], 0, ',', '.'); ?></b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <?= $this->endSection(); ?>