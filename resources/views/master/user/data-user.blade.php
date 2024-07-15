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
        <button type="button" class="btn btn-sm btn-primary" onclick="window.location='{{ route('create-user') }}'">
          <i class="fas fa-plus-circle"></i> Add Province
        </button>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead>
                <tr>
                        <th>ID User</th>
                        <th>Email</th>
                        <th>Role user</th>
                        <th>ID Role</th>
                        <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th>{{ $user->iduser }}</th>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->nama_role }}</td>
                        <th>{{ $user->idrole }}</th>
                        <td>
                                <button onclick="window.location='{{ route('edit-user', $user->iduser) }}'" type="button" class="btn btn-sm btn-warning" title="Edit data" >
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form method="POST" action="{{ route('destroy-user', $user->iduser) }}" style="display: inline-block">
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
    </div>
</div>
@endsection