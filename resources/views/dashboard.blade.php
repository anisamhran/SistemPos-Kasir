@extends('partials.main')

@section('title')
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Selamat Datang</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
    </ol>
  </div>
@endsection

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card" style="background-color: #D4F0F7;">
                <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h5 class="card-title text-primary">Jumlah User</h5>
                        <p class="card-text"><span style="font-weight: bold; font-size: 24px;">{{  $userCount  }}</span></p>
                    </div>
                    <i class="fas fa-users fa-2x" style="flex-shrink: 0;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class = "card" style="background-color: #D4F0F7;">
                <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h5 class="card-title text-primary">Jumlah Barang</h5>
                        <p class="card-text"><span style="font-weight: bold; font-size: 24px;">{{ $barangCount }}</span></p>
                    </div>
                    <i class="fas fa-box fa-2x" style="flex-shrink: 0;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class = "card" style="background-color: #D4F0F7;">
                <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h5 class="card-title text-primary">Jumlah Barang</h5>
                        <p class="card-text"><span style="font-weight: bold; font-size: 24px;">{{ $barangCount }}</span></p>
                    </div>
                    <i class="fas fa-box fa-2x" style="flex-shrink: 0;"></i>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-4">
            <div class= "card" style="background-color: #D4F0F7;">
                <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h5 class="card-title text-primary">Penjualan</h5>
                        <p class="card-text"><span style="font-weight: bold; font-size: 24px;">{{ $penjualanCount }}</span></p>
                    </div>
                    <i class="fas fa-store fa-2x" style="flex-shrink: 0;"></i>
                </div>
            </div>
        </div> --}}
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title text-primary">Daftar User</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Peran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users->sortByDesc('created_at')->take(7) as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->role->nama_role }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title text-primary">Daftar Barang</h5>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $barang)
                                <tr>
                                    <td>{{ $barang->nama }}</td>
                                    <td>{{ $barang->nama_jenis }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title text-primary">Daftar User</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Peran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users->sortByDesc('created_at')->take(7) as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->role->nama_role }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title text-primary">Daftar Vendor</h5>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Vendor</th>
                                <th>Badan Hukum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendors as $vendor)
                                <tr>
                                    <td>{{ $vendor->nama_vendor }}</td>
                                    <td>{{ $vendor->nama_hukum }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
        
</div>
@endsection
