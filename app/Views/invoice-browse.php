<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container mt-4">

    <form action="/invoice/browse" method="get">
        <h3 class="mb-4"><b>Riwayat Pemesanan</b></h3>
        <div class="row">
            <label for="customerCode" class="form-control-label">Kode Customer</label>
        </div>
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="customerCode" class="form-control" placeholder="Masukkan kode customer">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary col-md-2">Search</button>
            </div>
        </div>
    </form>
    <br><br>
    <div class="table-responsive-xxl">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">No Transaksi</th>
                    <th scope="col">Tanggal Pembelian</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Total Diskon</th>
                    <th scope="col">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($browseData as $d) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $d['trx_number']; ?></td>
                        <td><?= $d['trx_date']; ?></td>
                        <td><?= $d['total_qty']; ?></td>
                        <td><?= $d['total_disc_val']; ?></td>
                        <td><?= $d['total_prc_aftr_disc']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?= $this->endSection(); ?>