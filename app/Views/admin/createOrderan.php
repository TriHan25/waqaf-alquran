<?= $this->extend('layout/template'); ?>

<?= $this->section('produk'); ?>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-7mQhpDl5nRA5nY9lr8F1st2NbIly/8WqhjTp+0oFxEA/QUuvlbF6M1KXezGBh3Nb" crossorigin="anonymous">

<script>
    var x = 1;

    $(document).ready(function() {
        var html = '<div id="field_plus" class="ml-auto col-sm-10"><select name="pilihan[]" data-action="sumDebit" onChange="addCharge(this,this.selectedIndex);" class="form-select <?= ($validation->hasError("produk")) ? "is-invalid" : ''; ?> " id="produk" name="produk[]" value="<?= old('produk'); ?>" id="validationCustom04"><option selected disabled value="">Choose...</option><?php foreach ($produk as $p) : ?><option value="<?= $p["id"]; ?>"><?= $p["nama"]; ?> | Rp <?= number_format($p['harga'], 0, ',', '.'); ?></option><?php endforeach; ?></select><div class="mt-2 mb-2"><input class="form-control" type="text" placeholder="jumlah" name="jumlah[]"><div id="produk" class="invalid-feedback "><?= $validation->getError("produk"); ?></div><input type="button" class="btn btn-danger mt-2" id="remove" name="remove" value="remove"></div></div>';


        $("#add").click(function() {
            $("#append_field").append(html);
            x++;
            console.log(x);
        });
        $("#append_field").on('click', '#remove', function() {
            $(this).closest('#field_plus').remove();
            x--;
            console.log(x);

        });
    });

    // $('body').on('change', '[data-action="sumDebit"]', function() {
    //     evaluateTotal();
    // });

    // function evaluateTotal() {
    //     var total = 0;
    //     $('[data-action="sum"]').each(function(_i, e) {
    //         var text = e.value;
    //         let result = text.substring(text.length - 10, text.length);
    //         let clean = parseInt(result.replace(/[&\/\\#,+()$~%.'":*?<>{}Rp]/g, ''));
    //         if (!isNaN(clean))
    //             total += clean;
    //         console.log(clean);
    //     });
    //     $('#harga').val(total);
    // }

    // function addCharge(select, elemIndex) {

    // var item = select.getElementsByTagName('option')[elemIndex];
    // var price = document.getElementById('pricetag');
    // // var finalPrice = "";
    // var itemPriceDOM = document.getElementById(`itemPrice`);
    // var itemLengthDOM = document.getElementById('itemLength');

    // /* Getting the price and showing it up */
    // var finalPrice = item.text.substring(item.text.length - 10, item.text.length);

    // itemPriceDOM.value = finalPrice;
    // document.getElementById("demo").innerHTML = finalPrice;
    // console.log(item);
    // console.log(itemPriceDOM);

    // var item = select.getElementsByTagName('option')[elemIndex];
    // console.log(item);
    // for (let i = 0; i <= x; i++) {
    //     if (condition) {

    //     }
    //     var itemPriceDOM = document.getElementsByName(`itemPrice[${i}]`);
    //     console.log(itemPriceDOM);

    //     var finalPrice = item.text.substring(item.text.length - 10, item.text.length);
    //     itemPriceDOM.value = finalPrice;
    //     document.getElementById("demo").innerHTML = finalPrice;
    // }
    // }
</script>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h2>Form Tambah Orderan</h2>
            <form action="/orderan/konfirmasi" method="POST" enctype="multipart/form-data">
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
                <?php
                $t = time();
                $n = 3;
                function getName($n)
                {
                    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $randomString = '';

                    for ($i = 0; $i < $n; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                    }

                    return $randomString;
                }

                // echo getName($n);
                ?>
                <p id="demo"></p>
                <input name="no_orderan" type="hidden" value="<?= $t . "-" . getName($n); ?>">
                <input name="status_p" type="hidden" value="1">
                <div class="form-group row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Pemesan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name='nama' value="<?= old('nama'); ?>" autofocus>
                        <div id="nama" class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="nomor" class="col-sm-2 col-form-label">No Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nomor')) ? 'is-invalid' : ''; ?>" id="nomor" name='nomor' value="<?= old('nomor'); ?>" autofocus>
                        <div id="nomor" class="invalid-feedback">
                            <?= $validation->getError('nomor'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="status_b" class="col-sm-2 col-form-label">Status Bayar</label>
                    <div class="col-sm-10">
                        <select class="form-select <?= ($validation->hasError('status_b')) ? 'is-invalid' : ''; ?>" id="status_b" name="status_b" value="<?= old('status_b'); ?>" id="validationCustom04">
                            <option selected disabled value="">Choose...</option>
                            <option value="1">DP</option>
                            <option value="2">Lunas</option>
                            <option value="3">Belum Bayar</option>
                        </select>
                        <div id="status_b" class="invalid-feedback">
                            <?= $validation->getError('status_b'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3" id="append_field">
                    <label for="produk" class="col-sm-2 col-form-label">Produk</label>
                    <div class="col-sm-10">
                        <select name="pilihan[]" data-action="sumDebit" onChange="addCharge(this,this.selectedIndex);" class="form-select <?= ($validation->hasError('produk')) ? 'is-invalid' : ''; ?>" id="produk" name="produk[]" value="<?= old('produk'); ?>" id="validationCustom04">
                            <option id="produk_buy" selected disabled value="">Choose...</option>
                            <?php foreach ($produk as $p) : ?>
                                <option id="produk_buy" value="<?= $p['id']; ?>"><?= $p['nama']; ?> | Rp <?= number_format($p['harga'], 0, ',', '.'); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="mt-2 mb-2">
                            <input class="form-control" type="text" placeholder="jumlah" name="jumlah[]">
                            <div id="produk" class="invalid-feedback">
                                <?= $validation->getError('produk'); ?>
                            </div>
                            <input type="button" class="btn btn-primary mt-2" id="add" name="add" value="add">
                        </div>
                    </div>
                </div>

                <a href="/orderan" class="btn btn-danger mr-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>