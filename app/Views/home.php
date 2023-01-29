<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<script>
    function onQtyValueChange(ketTotalHargaElementId, price, qty) {
        let totalHarga = price * qty;

        console.log("masuk eyyy", ketTotalHargaElementId);

        if (totalHarga > 0) {
            document.getElementById(ketTotalHargaElementId).innerHTML = `<span style="font-size: 9pt;">Total Harga</span><br><span style="color: green; font-weight: bold">IDR${totalHarga}</span>`;
        } else {
            document.getElementById(ketTotalHargaElementId).innerHTML = "";
        }
    }
</script>

<div class="container mt-4">
    <div class="row">
        <?php $i = 0; ?>
        <?php foreach ($books as $b) : ?>
            <div class="col-md-6">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="img/book/<?= $b['book_img']; ?>" class="img-fluid rounded-start" alt="<?= $b['book_title']; ?>" style="height: 310px;">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body ml-4">
                                <h5 class="card-title"><?= $b['book_title']; ?></h5>
                                <p class="card-text">
                                    <b>Pengarang: </b> <?= $b['book_author']; ?>
                                    <br>
                                    <b>Penerbit: </b> <?= $b['book_publisher']; ?>
                                    <br>
                                    <b>Genre: </b> <?= $b['type_name']; ?>
                                </p>

                                <p>
                                    <b>IDR<?= $b['unit_price_value']; ?></b>
                                    <br>
                                    <small class="text-muted">Stok tersedia: <?= $b['qty']; ?> eks</small>
                                </p>

                                <form role="search" id="qtyForm-<?= $i; ?>" class="mb-2" action="home/addToCart/<?= $b['id']; ?>/<?= $b['book_title']; ?>/<?= $b['book_img']; ?>/<?= $b['book_author']; ?>/<?= $b['book_publisher']; ?>/<?= $b['unit_price_value']; ?>/<?= $b['book_type_id']; ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input class="form-control me-2" type="number" id="qty" name="qty" value="0" onchange="onQtyValueChange('totalHarga-<?= $i; ?>',<?= $b['unit_price_value']; ?>, this.value)">
                                        </div>
                                        <div class="col-md-8">
                                            <div id="totalHarga-<?= $i++; ?>"></div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <button class="btn btn-md btn-outline-success" type="submit">
                                                <i class="fa fa-plus"></i>&nbsp; Tambah Ke Keranjang
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection(); ?>