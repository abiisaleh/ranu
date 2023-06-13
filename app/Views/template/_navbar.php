<!-- header section strats -->
<header class="header_section fixed-top">
    <div class="header_bottom">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="/">
                    <span>
                        Plaza Elektonik
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item <?= (uri_string() == 'produk') ? '' : 'active'; ?>">
                            <a class="nav-link" href="#home">Home</a>
                        </li>
                        <li class="nav-item <?= (uri_string() == 'produk') ? 'active' : ''; ?>">
                            <a class="nav-link" href="produk">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#cabang">Cabang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bg-warning rounded" href="/admin/dashboard">
                                <i class="fa fa-user mr-2" aria-hidden="true"></i>
                                <span>
                                    Admin
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- end header section -->