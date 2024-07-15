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
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between float-md-end">
      <button type="button" class="btn btn-sm btn-primary" onclick="window.location='{{ route('create-satuan') }}'">
        <i class="fas fa-plus-circle"></i> Add Province
      </button>
    </div>
    <div class="table-responsive p-3">
      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead>
          <tr>
                  <th>ID</th>
                  <th>Nama satuan</th>
                  <th>Status</th>
                  <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($satuans as $satuan)
              <tr>
                  <th>{{ $satuan->idsatuan }}</th>
                  <td>{{ $satuan->nama_satuan }}</td>
                   @php
                   $status = "";
                   if($satuan->status == 1){
                       $status = "Aktif";
                   }else{
                       $status = "Tidak Aktif";
                   }
                   @endphp
                  <td>{{ $status }}</td>
                  <td>
                    <button onclick="window.location='{{ route('edit-satuan', $satuan->idsatuan) }}'" type="button" class="btn btn-sm btn-warning" title="Edit data" >
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <form method="POST" action="{{ route('destroy-satuan', $satuan->idsatuan) }}" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger " title="Hapus data" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form> 
                </td>       
              </tr>
          @endforeach
      </tbody>
      </table>
    </div>
  </div>
</div>


{{-- <div class="card">
    <div class="card-header">
      <button type="button" class="btn btn-sm btn-primary" onclick="window.location='{{ route('create-satuan') }}'">
        <i class="fas fa-plus-circle"></i> Tambah satuan
      </button>
    </div>
    <div class="card-body">
        @if (session('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil</strong> {{ session('msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
@endif
     <table class="table table-sm table-striped table-bordered">
        <thead>
            <tr>
                    <th>No</th>
                    <th>Nama satuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($satuans as $satuan)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $satuan->nama_satuan }}</td>
                     @php
                     $status = "";
                     if($satuan->status_satuan == 1){
                         $status = "Aktif";
                     }else{
                         $status = "Tidak Aktif";
                     }
                     @endphp
                    <td>{{ $status }}</td>
                    <td>
                      <button onclick="window.location='{{ route('edit-satuan', $satuan->id_satuan) }}'" type="button" class="btn btn-sm btn-warning" title="Edit data" >
                          <i class="fas fa-edit"></i> Edit
                      </button>
                      <form method="POST" action="{{ route('destroy-satuan', $satuan->id_satuan) }}" style="display: inline-block">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger" title="Hapus data" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                              <i class="fas fa-trash-alt"></i> Hapus
                          </button>
                      </form> 
                  </td>       
                </tr>
            @endforeach
        </tbody>
     </table>
    </div>
  </div>    --}}
@endsection