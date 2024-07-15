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
      <button type="button" class="btn btn-sm btn-warning" onclick="window.location='{{ route('data-jenis-barang') }}'">
        Back
      </button>    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('save-jenis-barang') }}">
        @csrf
            <div class="form-group row mb-3">
              <label for="id_provinsi" class="col-sm-2 col-form-label">ID</label>
              <div class="col-sm-2">
                  <input type="text" class="form-control form-control-sm" id="" name="id_jenis_barang" readonly value="{{ $newlyCreatedId }}">
              </div>
            </div>      
            <div class="form-group row mb-3">
              <label for="nama_jenis" class="col-sm-2 col-form-label">Nama Jenis Barang</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" id="nama_jenis" name="nama_jenis">
              </div>
            </div>
            <div class="col-sm-12">
              <button type="submit" class="btn btn-sm btn-success" style="float: right; display: inline-block;">
                  Save
              </button>
          </div>          
      </form>
    </div>
  </div>
</div>


{{-- <div class="card">
  <div class="card-body">
    <p class="card-title">Data Jenis Barang</p>
    <div class="row">
      <div class="col-12">
<div class="card">
    <div class="card-header">
      <button type="button" class="btn btn-sm btn-warning" onclick="window.location='{{ route('data-jenis-barang') }}'">
         Kembali
      </button>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('save-jenis-barang') }}">
        @csrf
        <form>
            <div class="row mb-3">
              <label for="nama_jenis" class="col-sm-2 col-form-label">Nama Jenis Barang</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" id="nama_jenis" name="nama_jenis">
            </div>
            </div>
            <div class="row mb-3">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-3">
                    <select name="status" class="form-control" id="status" type="number">
                          <option value="1">Aktif</option>
                          <option value="0">Tidak Aktif</option>
                    </select>
                  </div>
                </div>
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-sm btn-success">
                            Simpan
                        </button>
                      </div>
                    </div>
              </div>
            </div>
          </form>
    </div>
  </div>
</div> --}}

@endsection