<?= $this->extend('layout/template'); ?>

<?= $this->section('produk'); ?>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-7mQhpDl5nRA5nY9lr8F1st2NbIly/8WqhjTp+0oFxEA/QUuvlbF6M1KXezGBh3Nb" crossorigin="anonymous">

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h2>Form konfirmasi Orderan</h2>
            <?php if ($konfirmasi == null) { ?>
                <div>
                    <h1>Data Kosong</h1>
                </div>
            <?php } else { ?>
                <form action="/orderan/update/<?= $konfirmasi['id']; ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <!-- input with value -->
                    <input name="no_orderan" type="hidden" value="<?= $konfirmasi['no_orderan']; ?>">
                    <input name="nama_pemesan" type="hidden" value="<?= $konfirmasi['nama_pemesan']; ?>">
                    <input name="nomor_pemesan" type="hidden" value="<?= $konfirmasi['nomor_pemesan']; ?>">
                    <input name="status_pembayaran" type="hidden" value="<?= $konfirmasi['status_pembayaran']; ?>">
                    <input name="harga" type="hidden" value="<?= $harga; ?>">

                    <?php foreach ($konfirmasi['produk'] as $k => $p) : ?>
                        <input name="produk[]" type="hidden" value="<?= $p; ?>">
                    <?php endforeach; ?>

                    <?php foreach ($konfirmasi['jumlah'] as $k => $j) : ?>
                        <input name="jumlah[]" type="hidden" value="<?= $j; ?>">
                    <?php endforeach; ?>
                    <!-- end input with value -->

                    <div class="form-group row mb-3">
                        <div class="p-2 text-dark mr-auto ml-auto col-sm-11 text-center bg-warning rounded">
                            <h3>Pastikan data sudah benar</h3>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="nama_pemesan" class="col-sm-2 col-form-label">Nama Pemesan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_pemesan" name='nama_pemesan' value="<?= $konfirmasi['nama_pemesan']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="nomor_pemesan" class="col-sm-2 col-form-label">Nomor Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nomor_pemesan" name='nomor_pemesan' value="<?= $konfirmasi['nomor_pemesan']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="status_pembayaran" class="col-sm-2 col-form-label">Status Bayar</label>
                        <div class="col-sm-10">
                            <?php
                            if ($konfirmasi['status_pembayaran'] == 1) {
                            ?>
                                <input type="text" class="form-control" placeholder="DP" readonly>
                            <?php
                            } elseif ($konfirmasi['status_pembayaran'] == 2) {
                            ?>
                                <input type="text" class="form-control" placeholder="Lunas" readonly>
                            <?php
                            } elseif ($konfirmasi['status_pembayaran'] == 3) {
                            ?>
                                <input type="text" class="form-control" placeholder="Belum Bayar" readonly>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group row mb-3" id="append_field">
                        <label for="produk" class="col-sm-2 col-form-label">Produk</label>
                        <div class="col-sm-5">
                            <?php
                            foreach ($nama_produk as $k => $n) :
                            ?>
                                <input class="form-control" type="text" placeholder="<?= $n; ?>" readonly>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-sm-5">
                            <?php
                            foreach ($konfirmasi['jumlah'] as $k => $j) :
                            ?>
                                <input class="form-control" type="text" placeholder="<?= $j; ?>" readonly>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="harga" class="col-sm-2 col-form-label">Total Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="Rp <?= number_format($harga, 0, ',', '.'); ?>" readonly>
                        </div>
                    </div>

                    <a href="/orderan/edit/<?= $konfirmasi['no_orderan']; ?>" class="btn btn-danger mr-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>
            <?php } ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>