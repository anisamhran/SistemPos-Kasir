@extends('partials.main')

@section('title')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Data Retur</h1>
    </div> 
@endsection

@section('content')
<div class="col-lg-12">
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between float-md-end">
      <button type="button" class="btn btn-sm btn-primary" onclick="window.location='{{ route('create-retur') }}'">
        <i class="fas fa-plus-circle"></i> Buat Retur
      </button>
    </div>
    <div class="table-responsive p-3">
      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead>
          <tr>
                  <th>ID Retur</th>
                  <th>ID Penerimaan</th>
                  <th>ID User</th>
                  {{-- <th>Vendor</th>
                  <th>Total</th> --}}
                  <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($returns as $hasil)
              <tr>
                  <th>{{ $hasil->idretur }}</th>
                  <td>{{ $hasil->idpenerimaan }}</td>
                  <td>{{ $hasil->iduser }}</td>
                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter"  onclick="detail({{ $hasil->idretur }})">Detail
                  </button>
                </td>       
              </tr>
          @endforeach
      </tbody>
      </table>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Detail Retur</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="tableDetail" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th scope="col">Id Detil Retur</th>
                <th scope="col">Id Retur</th>
                <th scope="col">Id Detail Penerimaan</th>
                <th scope="col">Alasan</th>
                <th scope="col">Jumlah </th>
              </tr>
            </thead>
            <tbody id="detailContent">
              <!-- Table content will be dynamically filled using JavaScript -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>






<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function detail(id) {
        $.ajax({
            type: "GET",
            url: `/detail-retur/${id}`,
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                $('#tableDetail tbody').empty();
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        let row = `
                            <tr>
                                <td>${data[i].iddetail_retur}</td>
                                <td>${data[i].idretur}</td>
                                <td>${data[i].iddetail_penerimaan}</td>
                                <td>${data[i].alasan}</td>
                                <td>${data[i].jumlah}</td>
                            </tr>`;
                        $('#tableDetail tbody').append(row);
                    };
                    $('#detailModal').modal('show'); // Corrected modal ID
                } else {
                    alert('DATA TIDAK DITEMUKAN !');
                }
            }
        });
    }
</script>


@endsection
