<?= $this->extend('layout/templateUser'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layout/navbar_cek'); ?>
<div class="container">
    <div class="resi">
        <div class="search-resi">
            <form action="" method="get">
                <div class="search-box input-group mb-3">
                    <input type="text" class="form-control" placeholder="No Orderan" name="keyword">
                    <button class="btn btn-success" type="submit">Search</button>
                </div>
            </form>
            <form action="" method="get">
                <div class="input-group mb-3">
                    <a href="/Cek_Orderan">
                        <button class="btn btn-danger">Clear Search</button>
                    </a>
                </div>
            </form>
        </div>
        <div class="table-section">
            <table class="table table-cek-resi">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Orderan</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Tgl</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (2 * ($currentPage - 1)) ?>
                    <?php foreach ($orderan as $o) { ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $o['no_orderan']; ?></td>
                            <td><?= $o['nama_pemesan']; ?></td>
                            <td><?php
                                if ($o['status_pengerjaan'] == 1) {
                                    echo 'Dalam Proses';
                                } elseif ($o['status_pengerjaan'] == 2) {
                                    echo 'Editing';
                                } elseif ($o['status_pengerjaan'] == 3) {
                                    echo 'Finishing';
                                } elseif ($o['status_pengerjaan'] == 4) {
                                    echo 'Pengiriman';
                                } elseif ($o['status_pengerjaan'] == 5) {
                                    echo 'Selesai';
                                }
                                ?></td>
                            <td><?= $o['created_at']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <table class="table table-cek-resi2">
            <thead>
                <tr>
                    <th class="no1">No</th>
                    <th>No Orderan</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 + (2 * ($currentPage - 1)) ?>
                <?php foreach ($orderan as $o) { ?>
                    <tr>
                        <td class="no1"><?= $i++; ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $o['no_orderan']; ?>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item"><?= $o['nama_pemesan']; ?></a></li>
                                    <li><a class="dropdown-item"><?php
                                                                    if ($o['status_pengerjaan'] == 1) {
                                                                        echo 'Dalam Proses';
                                                                    } elseif ($o['status_pengerjaan'] == 2) {
                                                                        echo 'Editing';
                                                                    } elseif ($o['status_pengerjaan'] == 3) {
                                                                        echo 'Finishing';
                                                                    } elseif ($o['status_pengerjaan'] == 4) {
                                                                        echo 'Pengiriman';
                                                                    } elseif ($o['status_pengerjaan'] == 5) {
                                                                        echo 'Selesai';
                                                                    }
                                                                    ?></a></li>
                                    <li><a class="dropdown-item"><?= $o['created_at']; ?></a></li>
                                </ul>
                            </div>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?= $pager->links('orderan', 'order_pagination'); ?>
    </div>

    <a class="link-wa" target="_blank" href="https://wa.me/6281293841173?text=Halo%20saya%20ingin%20pesan%0AProduk:%0AJumlah:%0ATotal%20Harga:%0AAlamat:%0ANo%20Telepon:">
        <div id="whatsapp">
            <i class="fa-brands fa-whatsapp fa-lg"></i> Chat Via Whatsapp
        </div>
    </a>
</div>

<?= $this->endSection(); ?>