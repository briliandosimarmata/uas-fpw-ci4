<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container mt-4">
    <form action="">
        <div class="row">
            <div class="col-md-7">
                <div class="cart-item">
                    <div class="row g-0 ">
                        <div class="col-md-3">
                            <input type="checkbox" id="naruto" name="naruto" value="naruto" class="form-check-input me-3">
                            <img src="/img/book/naruto-42.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-9">
                            <h5><b>Naruto Vol. 42</b></h5>
                            <p style="margin-top: -10px; font-style: italic;">by Masashi Kishimoto</p>
                            <p style="margin-top: -5px; font-size: 11pt;"><b>Publisher: </b> Gramedia</p>
                            <p style="margin-top: -18px; font-size: 14pt;"><b>IDR250000</b></p>
                            <p style="text-align: right;">Total Item: 2 eks | <a href=""><i class="fa fa-trash"></i></a></p>
                        </div>
                    </div>
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
                        </div>
                        <div class="col" style="text-align: right;">
                            <span>IDR5000000</span>
                            <br>
                            <span>IDR40000</span>
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
                </div>
            </div>
        </div>
    </form>

</div>
<?= $this->endSection(); ?>