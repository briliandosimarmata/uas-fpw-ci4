<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<script>
    function setCustomerInput(stringJson) {
        let obj = JSON.parse(stringJson);
        document.getElementById("customer").value = obj["customer_name"];
        document.getElementById("address").value = obj["customer_address"];
        document.getElementById("customerId").value = obj["id"];

        document.getElementById("customer-autcomplete-item").innerHTML = "";
    }

    function showHint(str) {
        let listHtml = "";

        if (str.length == 0) {
            document.getElementById("customer-autcomplete-item").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let objRes = JSON.parse(this.responseText);


                    objRes.forEach(element => {
                        listHtml = listHtml.concat(`
                                <li class="list-group-item">
                                    <button class="btn" value='${JSON.stringify(element)}' onclick="setCustomerInput(this.value)" type="button" style="font-weight: bold;"> ${element['customer_code']} | ${element['customer_name']} </button>
                                </li>
                        `)
                    });

                    document.getElementById("customer-autcomplete-item").innerHTML = listHtml;
                }
            };
            xmlhttp.open("GET", "customer/getAll/" + str, true);
            xmlhttp.send();
        }
    }
</script>

<div class="container mt-4">
    <form action="invoice/save" method="post" style="margin-bottom: 5rem;">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <h3 class="mb-4"><b>Invoicing</b></h3>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="customer" class="form-label">Pelanggan</label>
                        <input type="text" id="customer" name="customer" placeholder="Wajib isi nama customer..." class="form-control" onkeyup="showHint(this.value)">
                        <div class="autocomplete-area" id="customer-autcomplete">
                            <ul class="list-group list-group-flush" id="customer-autcomplete-item">
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="trxNumber" class="form-label">No. Transaksi</label>
                        <input type="text" name="trxNumber" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-8">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" name="address" disabled></textarea>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <label class="form-label">Detail Harga (IDR)</label>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item" style="display: inline-block;">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="qty" class="form-label">Total Qty</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="qty" value="<?= $invoiceHeader['total_qty']; ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item" style="display: inline-block;">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="harga" class="form-label">Total Harga</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" value="<?= $invoiceHeader['total_prc']; ?>" name="harga" class="form-control" readonly>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item" style="display: inline-block;">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="diskon" class="form-label">Total Diskon</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" value="<?= $invoiceHeader['total_disc_val']; ?>" name="diskon" class="form-control" readonly>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item" style="display: inline-block;">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="hargaKes" class="form-label"><b> Total Harga Keseluruhan</b></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" value="<?= $invoiceHeader['total_prc_aftr_disc']; ?>" name="hargaKes" class="form-control" readonly>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-header">
                                <label class="form-label">Detail Pembelian</label>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive-xxl">
                                    <table class="table table-light table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Judul Buku</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Harga Satuan (IDR)</th>
                                                <th scope="col">Total Harga (IDR)</th>
                                                <th scope="col">Total Diskon (IDR)</th>
                                                <th scope="col">Total Bonus Diskon (IDR)</th>
                                                <th scope="col">Total Keseluruhan (IDR)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($invoiceDetails as $d) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i++; ?></th>
                                                    <td><?= $d['book_title']; ?></td>
                                                    <td><?= $d['book_qty']; ?></td>
                                                    <td><?= $d['unit_price']; ?></td>
                                                    <td><?= $d['book_price']; ?></td>
                                                    <td><?= $d['book_disc_val']; ?></td>
                                                    <td><?= $d['book_type_disc_val']; ?></td>
                                                    <td><?= $d['book_price_aftr_disc']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="col-md-2 invoice-pay">
                    <small>Total Harga Keseluruhan: </small>
                    <h4>IDR<?= $invoiceHeader['total_prc_aftr_disc']; ?></h4>
                    <button type="submit" class="btn btn-lg btn-primary col-md-12" style="height: 8%;">
                        <h4 style="vertical-align: middle;"><i class="fa-solid fa-cash-register"></i> &nbsp;Bayar</h4>
                    </button>
                </div>

            </div>
        </div>

        <input type="text" name="invoiceDetails" value='<?= json_encode($invoiceDetails); ?>' style="display: none;">
        <input type="text" id="customerId" name="customerId" style="display: none;">
    </form>
</div>

<div class="container mt-4">
    <h3 class="mb-4"><b>Pembayaran Pesanan</b></h3>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    Info Penerima Pesanan
                </div>
                <div class="card-body">
                    <h5 class="card-title">Qolby Azizah</h5>
                    <p class="card-text">Jl Batik ayu no 4, Bandung</p>
                    <a href="#" class="btn btn-primary">Ubah data penerima</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    Item Pesanan
                </div>
                <div class="card-group">
                    <div class="card">
                        <img class="card-img-top" src=".../100px180/" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Nama Buku</h5>
                            <p class="card-text">harga barang</p>
                            <p class="card-text"><small class="text-muted">jumlah barang</small></p>
                            <a href="#" class="btn btn-primary">Edit barang</a>
                        </div>
                    </div>
                    <div class="card">
                        <img class="card-img-top" src=".../100px180/" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Brilian Pria Paling Gagah</h5>
                            <p class="card-text">20000</p>
                            <p class="card-text"><small class="text-muted">2 barang</small></p>
                            <a href="#" class="btn btn-primary">Edit barang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Pilih Metode Pembayaran
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">Transfer Bank</a>
        <a class="dropdown-item" href="#">E-Wallet</a>
        <a class="dropdown-item" href="#">Minimarket (Alfamart)</a>
    </div>
</div>

<div class="col-md-5">
    <div class="cart-total ms-5">
        <div class="row">
            <div class="col">
                <h5><b>Ringkasan Harga</b></h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span>Total Harga (2 eks)</span>
                <br>
                <span>Total Diskon Buku</span>
                <br>
                <span>Total Ongkos Kirim</span>
            </div>
            <div class="col" style="text-align: right;">
                <span>IDR5000000</span>
                <br>
                <span>IDR40000</span>
                <br>
                <span>IDR10000</span>
            </div>
        </div>
        <hr>

        <div class="row mt-3">
            <div class="col">
                <h5><b>Total Harga</b></h5>
            </div>
            <div class="col" style="text-align: right;">
                <h5><b>IDR 40600000</b></h5>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <a href="" type="submit" class="btn btn-lg btn-primary col-md-12">Bayar</a>
            </div>
        </div>
    </div>
</div>
</div>
</form>

</div>

<?= $this->endSection(); ?>