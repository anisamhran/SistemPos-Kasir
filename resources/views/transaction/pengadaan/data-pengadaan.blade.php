@extends('partials.main')

@section('title')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Pengadaan</h1>
    </div> 
@endsection

@section('content')
<div class="col-lg-12">
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between float-md-end">
      <button type="button" class="btn btn-sm btn-primary ms-auto" onclick="window.location='{{ route('create-pengadaan') }}'">
        <i class="fas fa-plus-circle"></i> Add Pengadaan
      </button>
    </div>
    <div class="table-responsive p-3">
      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead>
          <tr>
                  <th>ID Pengadaan</th>
                  <th>ID User</th>
                  <th>Vendor</th>
                  <th>Total</th>
                  <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($pengadaans as $hasil)
              <tr>
                  <th>{{ $hasil->idpengadaan }}</th>
                  <td>{{ $hasil->user_iduser }}</td>
                  <td>{{ $hasil->vendor->nama_vendor }}</td>
                  <td>{{ number_format($hasil->total_nilai, 2, ',', '.') }}</td>                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter"  onclick="detail({{ $hasil->idpengadaan }})">Detail</button>
                </td>       
              </tr>
          @endforeach
      </tbody>
      </table>
    </div>
  </div>
</div>


          <!-- Modal Center -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Detail Pengadaan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="table-responsive">
                  <table id="tableDetail" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Id Detil</th>
                        <th scope="col">Id Pengadaan</th>
                        <th scope="col">Barang</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Sub Total</th>
                      </tr>
                    </thead>
                    <tbody id="detailContent">
                      <!-- Table content will be dynamically filled using JavaScript -->
                    </tbody>
                  </table>               
                 </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>


  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  {{-- <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script> --}}


  <script>
   function detail(id){

                $.ajax({
                    type: "GET",
                    url: `/detail-pengadaan/${id}`,
                    dataType: "JSON",
                    success: function (data) {
                        console.log(data);
                        $('#tableDetail tbody').empty();
                        if(data.length>0){
                        for(let i=0; i<data.length; i++){
                            let row = `
                                        <tr>
                                            <td>${data[i].iddetail_pengadaan}</td>
                                            <td>${data[i].idpengadaan}</td>
                                            <td>${data[i].nama}</td>
                                            <td>${data[i].jumlah}</td>
                                            <td>${number_format(data[i].harga_satuan, 2, ',', '.')}</td>
                                            <td>${number_format(data[i].sub_total, 2, ',', '.')}</td>
                                            </tr>`;
                                            $('#tableDetail tbody').append(row);
                        };
                        $('#exampleModal').modal('show');

                    }
                    else{
                        alert('DATA TIDAK DITEMUKAN !');
                    }

                    }
                });


            }
</script>


@endsection
