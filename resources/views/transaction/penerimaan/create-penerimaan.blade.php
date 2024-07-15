@extends('partials.main')

@section('title')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Penerimaan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
        </ol>
    </div>
@endsection

@section('content')
<div class='col-lg-12'>
    <!-- Modal basic -->
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Penerimaan</h6>
        </div>
        <div class="card-body">
            <form id="formPenerimaan" action="{{ route('terima-pengadaan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                <label for="id_pengadaan">List Pengadaan:</label>
                <select name="idpengadaan" id="idpengadaan" class="form-control">
                    <option value="" selected>Silahkan Memilih Pengadaan</option>
                    @foreach ($pengadaans as $pengadaan)
                    <option value="{{ $pengadaan->idpengadaan }}">
                        {{ $pengadaan->idpengadaan }} </option>
                    @endforeach
                </select>
            </div>
            {{-- <input type="hidden" name="idpengadaan" id="selectedPengadaan" value=""> --}}
            <button type="submit" class="btn btn-primary mt-3 float-right">Terima Pengadaan</button>
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
                        <th>ID Detail Pengadaan</th>
                        <th>ID Pengadaan</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
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
    // When the value of idpengadaan changes
    $('#idpengadaan').change(function () {
        var idPengadaan = $(this).val();

        // Call the function to update the detail table
        updateDetailTable(idPengadaan);
    });

    // Function to update the detail table
    function updateDetailTable(idPengadaan) {
        $.ajax({
            type: "GET",
            url: `/detail-pengadaan/${idPengadaan}`,
            dataType: "JSON",
            success: function (data) {
                console.log(data);

                $('#detailTableBody').empty();
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        let row = `
                            <tr>
                                <td>${data[i].iddetail_pengadaan}</td>
                                <td>${data[i].idpengadaan}</td>
                                <td>${data[i].nama}</td>
                                <td>${data[i].jumlah}</td>
                                <td>${number_format(data[i].sub_total, 2, ',', '.')}</td>
                            </tr>`;
                        $('#detailTableBody').append(row);
                    }

                    // Optional: Update modal content based on the first item in data
                    // detail(data[0].idpengadaan);
                } else {
                    alert('DATA TIDAK DITEMUKAN!');
                }
            },
        });
    }

   // Function to handle the "Terima Pengadaan" button click
   $('#formPenerimaan button').click(function (e) {
    e.preventDefault(); // Prevent the form from submitting

    // Validate if a pengadaan is selected
    var selectedPengadaan = $('#idpengadaan').val();
    if (!selectedPengadaan) {
        alert('Pilih pengadaan terlebih dahulu.');
        return;
    }

    // Set the selectedPengadaan value before submitting the form
    $('#selectedPengadaan').val(selectedPengadaan);

    // If the validation passes, submit the form
    $('#formPenerimaan').submit();
});

</script>
    

@endsection




