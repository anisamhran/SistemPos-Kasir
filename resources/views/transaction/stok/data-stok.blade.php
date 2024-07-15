@extends('partials.main')

@section('title')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Stok barang</h1>
    </div> 
@endsection

@section('content')
<div class="col-lg-12">
  <div class="card mb-4">
    <div class="table-responsive p-3">
      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead>
            <tr>
                <th>ID Barang</th>
                <th>Nama</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stokBarangs as $stokBarang)
                <tr>
                    <td>{{ $stokBarang->idbarang }}</td>
                    <td>{{ $stokBarang->nama }}</td>
                    <td>{{ $stokBarang->stok }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


    

@endsection
