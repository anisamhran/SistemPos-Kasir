<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
        <img src="{{ asset('backend/img/logo/logo2.png') }}">
      </div>
      <div class="sidebar-brand-text mx-3">RuangAdmin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Features
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
        aria-expanded="true" aria-controls="collapseBootstrap">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>Tabel Master</span>
      </a>
      <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Tabel Master</h6>
          <a class="collapse-item" href="{{ route('data-satuan') }}">Satuan</a>
          <a class="collapse-item" href="{{ route('data-badan-hukum') }}">Badan Hukum</a>
          <a class="collapse-item" href="{{ route('data-jenis-barang') }}">Jenis Barang</a>
          <a class="collapse-item" href="{{ route('data-barang') }}">Barang</a>
          <a class="collapse-item" href="{{ route('data-vendor') }}">Vendor</a>
          <a class="collapse-item" href="{{ route('data-user') }}">User</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Deleted History</span>
      </a>
      <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Deleted History</h6>
          <a class="collapse-item" href="{{ route('data-satuan-dihapus') }}">Satuan</a>
          <a class="collapse-item" href="{{ route('data-badan-hukum-dihapus') }}">Badan Hukum</a>
          <a class="collapse-item" href="{{ route('data-jenis-barang-dihapus') }}">Jenis Barang</a>
          <a class="collapse-item" href="{{ route('data-barang-dihapus') }}">Barang</a>
          <a class="collapse-item" href="{{ route('data-vendor-dihapus') }}">Vendor</a>
          <a class="collapse-item" href="{{ route('data-user-dihapus') }}">User</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
        aria-controls="collapseTable">
        <i class="fas fa-fw fa-table"></i>
        <span>Transactions</span>
      </a>
      <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Transactions</h6>
          <a class="collapse-item" href="{{ route('data-pengadaan') }}">Pengadaan</a>
          <a class="collapse-item" href="{{ route('data-penerimaan') }}">Penerimaan</a>
          <a class="collapse-item" href="{{ route('data-retur') }}">Retur</a>
          <a class="collapse-item" href="{{ route('data-penjualan') }}">Penjualan</a>
          <a class="collapse-item" href="{{ route('data-stok') }}">Stok</a>
          {{-- <a class="collapse-item" href="{{ route('data-barang-dihapus') }}">Barang</a>
          <a class="collapse-item" href="{{ route('data-vendor-dihapus') }}">Vendor</a>
          <a class="collapse-item" href="{{ route('data-user-dihapus') }}">User</a> --}}
        </div>
      </div>
    </li>
    <hr class="sidebar-divider">
    <div class="version" id="version-ruangadmin"></div>
  </ul>
