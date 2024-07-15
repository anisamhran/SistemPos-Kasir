@extends('partials.main')

@section('title')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Tambah Pengadaan</h1>
    </div>
@endsection

@section('content')
<div class="col-xl-8 col-lg-9">
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Pengadaan</h6>
    </div>
    <div class="card-body">
      <form action="{{ route('save-pengadaan') }}" method="POST" id="pengadaanForm">
        @csrf
        <div class="form-group">
            <label for="vendor_id">Vendor:</label>
           <!-- Pastikan nilai pada select tidak kosong -->
<select name="vendor_id" id="vendor_id" class="form-control">
  <option value="" disabled selected>Silakan pilih vendor</option>
  @foreach($vendors as $vendor)
    <option value="{{ $vendor->idvendor }}">{{ $vendor->nama_vendor }}</option>
  @endforeach
</select>
        </div>
        <div class="form-group">
            <label for="barang_id">Barang:</label>
            <select name="barang_id" id="barang_id" class="form-control">
              <option value="" disabled selected>Silakan pilih barang</option>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->idbarang }}" data-harga="{{ $barang->harga }}"    data-satuan="{{ $barang->satuan->nama_satuan }}" 
                      data-jenis="{{ $barang->jenis_barang->nama_jenis }}">{{ $barang->nama }} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="text" name="harga" id="harga" class="form-control" readonly >
        </div>
        <div class="form-group">
            <label for="satuan">Satuan:</label>
            <input type="text" name="satuan" id="satuan" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="jenis">Jenis Barang:</label>
            <input type="text" name="jenis" id="jenis" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah:</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary float-right" onclick="submitForm()">Submit</button>
    </form>
    </div>
  </div>
</div> 

<div class="col-xl-4 col-lg-3">
  <div class="card mb-4">
     <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">INFORMASI BIAYA</h6>
     </div>
     <div class="card-body">
        <div class="mb-3">
           <div class="text-gray-500">Subtotal
              <span id="subtotal" class="float-right">Rp. <span id="formattedSubtotal">0</span></span>
           </div>
        </div>
        <div class="mb-3">
           <div class="text-gray-500">PPN 11%
              <span id="ppn" class="float-right">Rp. <span id="formattedPPN">0</span></span>
           </div>
        </div>
        <div class="mb-3">
           <div class="text-gray-500">Grand Total
              <span id="grandTotal" class="float-right">Rp. <span id="formattedGrandTotal">0</span></span>
           </div>
        </div>
     </div>
  </div>
</div>


<script>
// Menanggapi perubahan pada dropdown barang
$('#barang_id').change(function () {
    // Panggil fungsi untuk mendapatkan data barang
    getBarangData(this);
});

// Fungsi untuk mengambil data barang menggunakan AJAX
function getBarangData(element) {
    // Pastikan nilai vendor_id diambil dari form
    var vendorId = $('#vendor_id').val();
    var id = $(element).find(':selected').val();
    
    $.ajax({
        url: '/create-pengadaan',  // Ganti dengan URL endpoint yang sesuai
        type: 'POST',
        data: {
            // _token: "{{ csrf_token() }}",
            vendor_id: vendorId,
            id: id,
        },
        success: function(response) {
            // Handle the response here, misalnya memperbarui elemen-elemen formulir
            $('#harga').val(response.harga);
            $('#satuan').val(response.satuan);
            $('#jenis').val(response.jenis);
        },
        error: function(xhr, status, error) {
            // Handle the error here
            console.error(xhr, status, error);
        }
    });
}


function submitForm() {
        // Before submitting the form, validate the vendor selection
        var vendorId = $('#vendor_id').val();
        if (vendorId === null || vendorId === "") {
            alert('Please select a vendor before submitting.');
            return;
        }

        // If the validation passes, submit the form
        $('#pengadaanForm').submit();
    }

   // <!-- NGISI HARGA, SATUAN, JENIS BARANG OTOMATIS -->
  $(document).ready(function () {
      // Menanggapi perubahan pada dropdown barang
      $('#barang_id').change(function () {
          // Mengambil data terkait dari option yang dipilih
          var selectedOption = $(this).find(':selected');

          // Mengupdate nilai pada input harga
          $('#harga').val(selectedOption.data('harga'));

          // Mengupdate nilai pada input satuan
          $('#satuan').val(selectedOption.data('satuan'));

          // Mengupdate nilai pada input jenis
          $('#jenis').val(selectedOption.data('jenis'));
      });
  });


  // <!-- NGISI HARGA, SATUAN, JENIS BARANG OTOMATIS -->
  $(document).ready(function () {
   $('#jumlah').on('input', function () {
      var harga = parseFloat($('#harga').val());
      var jumlah = parseFloat($(this).val());
      var subtotal = harga * jumlah;
      var ppn = subtotal * 0.11;
      var grandTotal = subtotal + ppn;

      // Fungsi untuk memformat angka menjadi format uang Rupiah
      function formatRupiah(angka) {
         var number_string = angka.toString();
         var split = number_string.split(',');
         var sisa = split[0].length % 3;
         var rupiah = split[0].substr(0, sisa);
         var ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

         if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
         }

         rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
         return rupiah;
      }

      // Menetapkan hasil perhitungan dan memformat ke elemen HTML
      $('#formattedSubtotal').text(formatRupiah(subtotal.toFixed(2)));
      $('#formattedPPN').text(formatRupiah(ppn.toFixed(2)));
      $('#formattedGrandTotal').text(formatRupiah(grandTotal.toFixed(2)));
   });
});

</script>

@endsection