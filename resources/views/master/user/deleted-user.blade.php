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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                            <th>ID User</th>
                            <th>Nama user</th>
                            <th>Email</th>
                            <th>Role user</th>
                            <th>ID Role</th>
                            <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trashes as $trash)
                        <tr>
                            <th>{{ $trash->id_user }}</th>
                            <td>{{ $trash->nama_user }}</td>
                            <td>{{ $trash->username }}</td>
                            <td>{{ $trash->nama_role }}</td>
                            <th>{{ $trash->id_role }}</th>
                            <td>
                                <a href="{{ route('restore-user-dihapus', $trash->id_user) }}" class="btn btn-outline-primary btn-sm mr-2" title="Kembalikan User" onclick="return confirm('Kembalikan data user ini?')">
                                    <i class="fas fa-download"></i> Kembalikan
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection