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
        <button type="button" class="btn btn-sm btn-warning" onclick="window.location='{{ route('data-user') }}'">
          Back
        </button>    </div>
      <div class="card-body">
        <form method="POST" action="{{ route('update-user', $user->iduser) }}">
          @csrf
          @method('put') 
              <div class="form-group row mb-3">
                <label for="id_provinsi" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" id="" name="id_barang" readonly value="{{ $user->iduser }}">
                </div>
              </div>      
              <div class="form-group row mb-3">
                <label for="username" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-sm" id="username" name="username" value="{{ $user->username }}">
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control form-control-sm" id="password" name="password" value="{{ $user->password }}">
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="status" class="col-sm-2 col-form-label">Role</label>
                  <div class="col-sm-3">
                    <select name="idrole" class="form-control" id="idrole" type="number">
                        @foreach ($roles as $role)
                            <option value="{{ $role->idrole }}" {{ $role->idrole == $user->idrole ? 'selected' : '' }}>
                                {{ $role->nama_role }}
                            </option>
                        @endforeach
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
