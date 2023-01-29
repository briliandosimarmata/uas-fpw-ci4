<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container mt-4">
    <form action="" method="post">
        <div class="row">
            <div class="col">
                <input type="text" class="fomr-control">
            </div>
        </div>
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