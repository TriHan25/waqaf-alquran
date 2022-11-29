<?= $this->extend('layout/template'); ?>

<?= $this->section('produk'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h2>Form Tambah Produk</h2>
            <form action="/produk/save" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <!-- <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">State</label>
                    <select class="form-select" id="validationCustom04">
                        <option selected disabled value="">Choose...</option>
                        <option>...</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid state.
                    </div>
                </div> -->
                <div class="form-group row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name='nama' value="<?= old('nama'); ?>" autofocus>
                        <div id="nama" class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="kategori" class="col-sm-2 col-form-label">kategori</label>
                    <div class="col-sm-10">
                        <select class="form-select <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>" id="kategori" name="kategori" value="<?= old('kategori'); ?>" id="validationCustom04">
                            <option selected disabled value="">Choose...</option>
                            <option value="1">Jasa</option>
                            <option value="2">Barang</option>
                        </select>
                        <div id="kategori" class="invalid-feedback">
                            <?= $validation->getError('kategori'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="harga" class="col-sm-2 col-form-label">harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= old('harga'); ?>">
                        <div id="harga" class="invalid-feedback">
                            <?= $validation->getError('harga'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="deskripsi" class="col-sm-2 col-form-label">deskripsi</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" value="<?= old('deskripsi'); ?>"><?= old('deskripsi'); ?></textarea>
                        <div id="deskripsi" class="invalid-feedback">
                            <?= $validation->getError('deskripsi'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="img" class="col-sm-2 col-form-label">img</label>
                    <div class="col-sm-2">
                        <img src="/img/default.png" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group mb-3">
                            <input type="file" class="form-control <?= ($validation->hasError('img')) ? 'is-invalid' : ''; ?>" id="img" name="img" onchange="previewImg()">
                            <label class="input-group-text" for="img">Upload</label>
                            <div id="img" class="invalid-feedback">
                                <?= $validation->getError('img'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="/produk" class="btn btn-danger mr-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>