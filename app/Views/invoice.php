<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

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
                        <input type="text" name="customer" class="form-control">
                        <div class="autocomplete-area">
                            <button class="btn" value=""> 1234 | YONO </button>
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
                        <textarea class="form-control" placeholder="Isi alamat..." name="address"></textarea>
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
    </form>
</div>
<?= $this->endSection(); ?>