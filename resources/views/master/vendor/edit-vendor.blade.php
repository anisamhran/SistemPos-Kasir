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
      <button type="button" class="btn btn-sm btn-warning" onclick="window.location='{{ route('data-vendor') }}'">
        Back
      </button>    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('update-vendor',$vendor->idvendor) }}">
        @csrf
        @method('PUT')
            <div class="form-group row mb-3">
              <label for="id_provinsi" class="col-sm-2 col-form-label">ID</label>
              <div class="col-sm-2">
                  <input type="text" class="form-control form-control-sm" id="" name="idvendor" readonly value="{{ $vendor->idvendor }}">
              </div>
            </div>      
            <div class="form-group row mb-3">
              <label for="nama_vendor" class="col-sm-2 col-form-label">Nama Vendor</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" id="nama_vendor" name="nama_vendor" value="{{old('nama_vendor', $vendor->nama_vendor)}}">
              </div>
            </div>
            <div class="form-group row mb-3">
              <label for="badan_hukum" class="col-sm-2 col-form-label">Badan Hukum</label>
              <div class="col-sm-5">
                <select name="badan_hukum" class="form-control" id="badan_hukum" type="number">
                  @foreach ($badan_hukum as $item)
                  <option value="{{ $item->id_badan_hukum }}" @if($item->id_badan_hukum == old('id_badan_hukum', $vendor->namabadan_hukum)) selected @endif>{{ $item->namabadan_hukum }}</option>
              @endforeach
                </select>
            </div>
            </div>
            <div class="form-group row mb-3">
              <label for="status" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select name="status" class="form-control" id="status" type="number">
                  <option value="1" @if(old('status', $vendor->status) == 1) selected @endif>Aktif</option>
                  <option value="0" @if(old('status', $vendor->status) == 0) selected @endif>Tidak Aktif</option>
              </select>  
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
    <div class="row">
      <div class="col-12">
<div class="card">
    <div class="card-header">
      <button type="button" class="btn btn-sm btn-primary" onclick="window.location='{{ route('data-vendor') }}'">
         Kembali
      </button>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('update-vendor', $vendor->idvendor) }}">
            @csrf
            @method('PUT')
        <form>
            <div class="row mb-3">
              <label for="nama_vendor" class="col-sm-2 col-form-label">Nama vendor</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm @error('nama_vendor') is-invalid @enderror" id="nama_vendor" name="nama_vendor" value="{{old('nama_vendor', $vendor->nama_vendor)}}">                @error('nama_vendor')
                <div class="invalid-feedback">
                    {{ $message }}
                  </div>
            @enderror
            </div>
            </div>
            <div class="row mb-3">
              <label for="badan_hukum" class="col-sm-2 col-form-label">Badan Hukum</label>
              <div class="col-sm-10">
                <select name="badan_hukum" class="form-control" id="badan_hukum" type="number">
                  @foreach ($badan_hukum as $item)
                  <option value="{{ $item->id_badan_hukum }}" @if($item->id_badan_hukum == old('id_badan_hukum', $vendor->namabadan_hukum)) selected @endif>{{ $item->namabadan_hukum }}</option>
              @endforeach
                </select>
            </div>
            </div>
            <div class="row mb-3">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-3">
                    <select name="status" class="form-control" id="status" type="number">
                        <option value="1" @if(old('status', $vendor->status) == 1) selected @endif>Aktif</option>
                        <option value="0" @if(old('status', $vendor->status) == 0) selected @endif>Tidak Aktif</option>
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