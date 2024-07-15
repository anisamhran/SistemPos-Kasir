<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BarangModel;
use App\Models\JenisBarang;
use App\Models\SatuanModel;
use App\Models\VendorModel;
use Illuminate\Http\Request;
use App\Models\PengadaanModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DetailPengadaanModel;
use Illuminate\Support\Facades\Auth;

class PengadaanController extends Controller
{

    public function index()
    {
        $pengadaans = PengadaanModel::all(); // Replace with your actual model query

        return view('transaction.pengadaan.data-pengadaan', ['pengadaans' => $pengadaans]);
    }


    public function create()
    {
        $vendors = VendorModel::all();
        $barangs = BarangModel::all();

        return view('transaction.pengadaan.create-pengadaan', compact('vendors', 'barangs'));
    }

    
    public function tambahPengadaan(Request $request)
{
    // Pastikan pengguna sudah diautentikasi
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Please log in to continue.');
    }

    // Mendapatkan data dari request
    $authenticatedUser = auth()->user(); // Change this line

    $vendorId = $request->input('vendor_id');
    $barangId = $request->input('barang_id');
    $harga = $request->input('harga');
    $satuan = $request->input('satuan');
    $jenis = $request->input('jenis');
    $jumlah = $request->input('jumlah');

    // Panggil stored procedure
    $result = DB::select('CALL tambah_pengadaan(?, ?, ?, ?, ?, ?, ?)', [
        $authenticatedUser->iduser, $vendorId, $barangId, $harga, $satuan, $jenis, $jumlah
    ]);

    // Redirect ke halaman yang sesuai (misalnya, halaman data-pengadaan)
    return redirect()->route('data-pengadaan', compact('result'))->with('success', 'Pengadaan added successfully.');
}

    public function detail($id){
        $detailPengadaans = DB::table('detail_pengadaan as d')
                            ->select('d.*','b.nama')
                            ->join('barang as b','b.idbarang','=','d.idbarang')
                            ->where('d.idpengadaan','=',$id)
                            ->get();

        return response()->json($detailPengadaans);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
