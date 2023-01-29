<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand" href="/"><i class="fas fa-store"></i> Home</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/invoice/browse">
                        <span><b>Browse Invoice</b></span>
                    </a>
                </li>
            </ul>
            <span class="cart-quantity"><?= $totalQtyCartItem; ?></span>
            <a href="/cart"><i class="fas fa-shopping-cart me-4"></i></a>
            <form class="d-flex" role="search" action="/search" method="get">
                <input class="form-control me-2" type="search" name="title" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>