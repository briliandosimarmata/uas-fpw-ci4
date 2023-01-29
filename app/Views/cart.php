<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<script>
    async function onValueCheckChange(value, id) {
        let v = value;
        let valObj = JSON.parse(v);

        let input = document.getElementById('cart').getElementsByTagName('input');



        let totalHargaEks = 0;
        let totalQty = 0;
        let totalDiscount = 0;
        let totalHarga = 0;

        for (let index = 0; index < input.length; index++) {
            const element = input[index];
            if (element.type === 'checkbox') {
                if (element.checked === true) {
                    totalHargaEks = totalHargaEks + JSON.parse(element.value)['price'];
                    totalQty = totalQty + parseInt(JSON.parse(element.value)['qty']);

                    let request = new XMLHttpRequest();
                    request.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            this.dis
                        }
                    };
                    request.open('GET', 'discount/countTotalBookDiscount/' + JSON.parse(element.value)['id'] + '/' +
                        JSON.parse(element.value)['qty'] + '/' + JSON.parse(element.value)['price'], false);
                    request.send();

                    totalDiscount = totalDiscount + JSON.parse(request.response)[JSON.parse(element.value)['id']];
                }
            }
        }

        totalHarga = totalHargaEks - totalDiscount;

        document.getElementById('totalQty').innerHTML = `Total Harga (${totalQty} eks)`;
        document.getElementById('totalHargaEks').innerHTML = `IDR${totalHargaEks}`;
        document.getElementById('totalDiskon').innerHTML = `IDR${totalDiscount}`;
        document.getElementById('totalHarga').innerHTML = `<b>IDR${totalHarga}</b>`;
        document.getElementById('buttonCheckout').innerHTML = `Beli (${totalQty})`;

    }
</script>

<a href="discount/countTotalBookDiscount/daa992c8-9f02-11ed-8738-009337e10b18/3/600000">Cobaaa</a>

<div class="container mt-4">
    <h3 class="mb-4"><b>Keranjang</b></h3>
    <form action="/invoice" method="post">
        <input type="checkbox" id="all-cart-items" name="all-cart-items" value="all" class="form-check-input me-3">
        <label for="all-cart-items">Pilih semua</label>
        <div class="row">
            <div class="col-md-7">
                <div id="cart">
                    <?php foreach ($cartItems as $item) : ?>
                        <div class="cart-item">
                            <div class="row g-0 ">
                                <div class="col-md-3">
                                    <input type="checkbox" id="<?= $item['id']; ?>" name="<?= $item['id']; ?>" value='<?= json_encode($item); ?>' onchange="onValueCheckChange(this.value, this.id)" class="form-check-input me-3">
                                    <img src="/img/book/<?= $item['img']; ?>" class="img-fluid" alt="">
                                </div>
                                <div class="col-md-9">
                                    <h5><b><?= $item['title']; ?></b></h5>
                                    <p style="margin-top: -10px; font-style: italic;">by <?= $item['author']; ?></p>
                                    <p style="margin-top: -5px; font-size: 11pt;"><b>Publisher: </b> <?= $item['publisher']; ?></p>
                                    <p style="margin-top: -18px; font-size: 14pt; color: green;"><b>IDR<?= $item['price']; ?></b></p>
                                    <p style="text-align: right;">Total Item: <b><?= $item['qty']; ?></b> eks | <a href="/cart/delete/<?= $item['id']; ?>"><i class="fa fa-trash"></i></a></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
                            <span id="totalQty">Total Harga (0 eks)</span>
                            <br>
                            <span>Total Diskon Buku</span>
                        </div>
                        <div class="col" style="text-align: right;">
                            <span id="totalHargaEks">IDR0</span>
                            <br>
                            <span id="totalDiskon">IDR0</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col">
                            <h5><b>Total Harga</b></h5>
                        </div>
                        <div class="col" style="text-align: right;">
                            <h5 id="totalHarga"><b>IDR0</b></h5>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <button id="buttonCheckout" type="submit" class="btn btn-lg btn-primary col-md-12">Beli (0)</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<?= $this->endSection(); ?>