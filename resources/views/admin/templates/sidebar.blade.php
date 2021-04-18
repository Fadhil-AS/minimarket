<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
  <div class="sb-sidenav-menu">
      <div class="nav">
          <div class="sb-sidenav-menu-heading">Home</div>
          <a class="nav-link" href="{{url('/admin')}}">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Dashboard
          </a>
          <div class="sb-sidenav-menu-heading">Interface</div>
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
              <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
              Data Master
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="{{url('/barang')}}"><i class="fas fa-box-open"></i>&nbsp;Barang</a>
                  <a class="nav-link" href="{{url('/produk')}}"><i class="fab fa-empire"></i>&nbsp;Produk</a>
                  <a class="nav-link" href="{{url('/pelanggan')}}"><i class="fas fa-users"></i>&nbsp;Pelanggan</a>
                  <a class="nav-link" href="{{url('/pemasokan')}}"><i class="fas fa-parachute-box"></i>&nbsp;Pemasok</a>
                  <a class="nav-link" href="{{url('/users')}}"><i class="fas fa-user"></i>&nbsp;User</a>
              </nav>
          </div>
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
            Transaksi
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="transaksi" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="{{url('/admin/pembelian')}}"><i class="fas fa-shopping-cart"></i>&nbsp;Pembelian</a>
            </nav>
          </div>
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
            Laporan
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="laporan" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="#"><i class="fas fa-money-check-alt"></i>&nbsp;Laporan</a>
            </nav>
          </div>
      </div>
  </div>
  <div class="sb-sidenav-footer">
      <div class="small">Logged in as:</div>
      Muhammad Fadhil A S
  </div>
</nav>