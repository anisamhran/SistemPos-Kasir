@extends('partials.main')

@section('title')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Retur</h1>
    </div>
@endsection

@section('content')
<div class='col-lg-12'>
    <!-- Modal basic -->
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Retur</h6>
        </div>
        <div class="card-body">
            <form id="formReturn" action="{{ route('retur') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                <label for="idpenerimaan">List Penerimaan:</label>
                <select name="idpenerimaan" id="idpenerimaan" class="form-control">
                    <option value="" selected>Silahkan Memilih Penerimaan</option>
                    @foreach ($penerimaans as $penerimaan)
                    <option value="{{ $penerimaan->idpenerimaan }}">
                        {{ $penerimaan->idpenerimaan }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="harga">Alasan</label>
                <input type="text" name="alasan" id="alasan" class="form-control" >
            </div>
            <input type="hidden" name="iddetail_penerimaan" id="iddetail_penerimaan">
            <button type="submit" class="btn btn-primary mt-3 float-right">Ajukan Retur</button>
        </form>
        </div>
    </div>
    <!-- modal vertically centered -->
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Detail Penerimaan</h6>
        </div>
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                <thead>
                    <tr>
                        <th>ID Detail Penerimaan</th>
                        <th>ID Penerimaan</th>
                        <th>ID Barang</th>
                        <th>Jumlah Terima</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody id="detailTableBody">

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<!-- ... Script sebelumnya ... -->

<script>
 // When the value of idpenerimaan changes
$('#idpenerimaan').change(function () {
    var idpenerimaan = $(this).val();

    // Set the value of the hidden input
    $('#idpenerimaan').val(idpenerimaan);

    // Call the function to update the detail table and get iddetail_penerimaan
    updateDetailTable(idpenerimaan);
});

// Function to update the detail table and fetch iddetail_penerimaan
function updateDetailTable(idpenerimaan) {
    $.ajax({
        type: "GET",
        url: `/detail-penerimaan/${idpenerimaan}`,
        dataType: "JSON",
        success: function (data) {
            console.log(data);

            $('#detailTableBody').empty();
            if (data.length > 0) {
                // Assuming there's a property named 'iddetail_penerimaan' in your data
                var iddetail_penerimaan = data[0].iddetail_penerimaan;

                // Set the value of the input field for iddetail_penerimaan
                $('#iddetail_penerimaan').val(iddetail_penerimaan);

                for (let i = 0; i < data.length; i++) {
                    let row = `
                        <tr>
                            <td>${data[i].iddetail_penerimaan}</td>
                            <td>${data[i].idpenerimaan}</td>
                            <td>${data[i].barang_idbarang}</td>
                            <td>${data[i].jumlah_terima}</td>
                            <td>${number_format(data[i].sub_total_terima, 2, ',', '.')}</td>
                        </tr>`;
                    $('#detailTableBody').append(row);
                }

                // Optional: Update modal content based on the first item in data
                // detail(data[0].idpenerimaan);
            } else {
                alert('DATA TIDAK DITEMUKAN!');
            }
        },
    });
}


   // Function to handle the "Ajukan Retur" button click
$('#formReturn button').click(function (e) {
    e.preventDefault(); // Prevent the form from submitting

    // Validate if a penerimaan is selected
    var selectedpenerimaan = $('#idpenerimaan').val();
    if (!selectedpenerimaan) {
        alert('Pilih penerimaan terlebih dahulu.');
        return;
    }

    // Set the selectedpenerimaan value before submitting the form
    $('#selectedpenerimaan').val(selectedpenerimaan);

    // If the validation passes, submit the form
    $('#formReturn').submit();
});




</script>
    

@endsection


    
