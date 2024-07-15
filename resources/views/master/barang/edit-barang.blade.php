@extends('partials.main')

@section('title')
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Province</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Province</li>
    </ol>
  </div>
@endsection

@section('content')
<div class="col-lg-12">
  <!-- Form Basic -->
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <button type="button" class="btn btn-sm btn-warning" onclick="window.location='{{ route('data-barang') }}'">
        Back
      </button>    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('update-barang', $barang->idbarang) }}">
        @csrf
        @method('PUT')
            <div class="form-group row mb-3">
              <label for="id_provinsi" class="col-sm-2 col-form-label">ID</label>
              <div class="col-sm-2">
                  <input type="text" class="form-control form-control-sm" id="" name="idbarang" readonly value="{{ $barang->idbarang }}">
              </div>
            </div>      
            <div class="form-group row mb-3">
              <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" id="nama" name="nama" value="{{old('nama', $barang->nama)}}">
              </div>
            </div>
            <div class="form-group row mb-3">
              <label for="jenis_barang" class="col-sm-2 col-form-label">Jenis Barang</label>
              <div class="col-sm-10">
                <select name="jenis_barang" class="form-control" id="jenis_barang" type="number">
                  @foreach ($jenis_barang as $item)
                  <option value="{{ $item->id_jenis_barang }}" @if($item->id_jenis_barang == old('id_jenis_barang', $barang->nama_jenis)) selected @endif>{{ $item->nama_jenis }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row mb-3">
              <label for="status" class="col-sm-2 col-form-label">Satuan</label>
              <div class="col-sm-10">
                <select name="idsatuan" class="form-control" id="idsatuan" type="number">
                  @foreach ($satuans as $satuan)
                      <option value="{{ $satuan->idsatuan }}" @if($satuan->idsatuan == old('idsatuan', $barang->idsatuan)) selected @endif>{{ $satuan->nama_satuan }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row mb-3">
              <label for="nama" class="col-sm-2 col-form-label">Harga</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" id="nama" name="harga" value="{{old('harga', $barang->harga)}}">
              </div>
            </div>
            <div class="form-group row mb-3">
              <label for="jenis_barang" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select name="status" class="form-control" id="status" type="number">
                  <option value="1" @if(old('status', $barang->status) == 1) selected @endif>Aktif</option>
                  <option value="0" @if(old('status', $barang->status) == 0) selected @endif>Tidak Aktif</option>
                </select>
              </div>
            </div>
            <div class="col-sm-12">
              <button type="submit" class="btn btn-sm btn-success" style="float: right; display: inline-block;">
                  Save
              </button>
          </div>          
    </div>
  </form>
  </div>
</div>
@endsection