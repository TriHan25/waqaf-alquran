<?= $this->extend('layout/template'); ?>

<?= $this->section('produk'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h2>Form Ubah Produk</h2>
            <form action="/orderan/konfirmasi-edit/<?= $orderan['no_orderan']; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input name="id" type="hidden" value="<?= $orderan['id']; ?>">
                <input name="no_orderan" type="hidden" value="<?= $orderan['no_orderan']; ?>">
                <div class="form-group row mb-3">
                    <label for="nama_pemesan" class="col-sm-2 col-form-label">Nama Pemesan</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_pemesan')) ? 'is-invalid' : ''; ?>" id="nama_pemesan" name='nama_pemesan' value="<?= (old('nama_pemesan')) ? old('nama_pemesan') : $orderan['nama_pemesan']; ?>" autofocus>
                        <div id="nama_pemesan" class="invalid-feedback">
                            <?= $validation->getError('nama_pemesan'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="nomor_pemesan" class="col-sm-2 col-form-label">No Telepon</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control <?= ($validation->hasError('nomor_pemesan')) ? 'is-invalid' : ''; ?>" id="nomor_pemesan" name='nomor_pemesan' value="<?= (old('nomor_pemesan')) ? old('nomor_pemesan') : $orderan['nomor_pemesan']; ?>">
                        <div id="nomor_pemesan" class="invalid-feedback">
                            <?= $validation->getError('nomor_pemesan'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="status_pembayaran" class="col-sm-2 col-form-label">Status Bayar</label>
                    <div class="col-sm-10">
                        <select class="form-select <?= ($validation->hasError('status_pembayaran')) ? 'is-invalid' : ''; ?>" id="status_pembayaran" name="status_pembayaran" value="<?= (old('status_pembayaran')) ? old('status_pembayaran') : $orderan['status_pembayaran']; ?>">
                            <option selected value="<?= $orderan['status_pembayaran']; ?>">
                                <?php if ($orderan['status_pembayaran'] == 1) { ?>
                                    DP
                                <?php } elseif ($orderan['status_pembayaran'] == 2) { ?>
                                    Lunas
                                <?php } elseif ($orderan['status_pembayaran'] == 3) { ?>
                                    Belum Bayar
                                <?php } ?>
                            </option>
                            <option value="1">DP</option>
                            <option value="2">Lunas</option>
                            <option value="3">Belum Bayar</option>
                        </select>
                        <div id="status_pembayaran" class="invalid-feedback">
                            <?= $validation->getError('status_pembayaran'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <?php foreach ($produk_orderan as $k => $v) { ?>

                        <?php if ($k == 0) { ?>
                            <label for="produk" class="col-sm-2 col-form-label">Produk</label>
                        <?php } else { ?>
                            <label for="produk" class="col-sm-2 col-form-label"></label>
                        <?php } ?>
                        <div class="col-sm-5">
                            <select class="form-select <?= ($validation->hasError('produk')) ? 'is-invalid' : ''; ?>" id="produk" name="produk[]" value="<?= (old('id_produk')) ? old('id_produk') : $v['id_produk']; ?>">
                                <option selected value="<?= $v['id_produk']; ?>">
                                    <?= $v['nama']; ?> | Rp <?= number_format($v['harga'], 0, ',', '.'); ?>
                                </option>

                                <!-- <option id="produk_buy" selected disabled value="<?= $v['id_produk']; ?>">Choose...</option> -->
                                <?php foreach ($produk as $p) : ?>
                                    <option id="produk_buy" value="<?= $p['id']; ?>"><?= $p['nama']; ?> | Rp <?= number_format($p['harga'], 0, ',', '.'); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="produk" class="invalid-feedback">
                                <?= $validation->getError('produk'); ?>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <input class="form-control" name="jumlah[]" type="text" value="<?= $v['jumlah']; ?>">
                        </div>
                    <?php } ?>
                </div>
                <a href="/produk" class="btn btn-danger mr-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>