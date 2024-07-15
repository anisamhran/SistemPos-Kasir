<?php

namespace App\Http\Controllers;

use App\Models\PenerimaanModel;
use App\Models\PengadaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dataPenerimaan()
    {
        $penerimaans = PenerimaanModel::all();
        
        return view('transaction.penerimaan.data-penerimaan', ['penerimaans' => $penerimaans]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $pengadaans = PengadaanModel::where('status', 1)
        ->whereNotIn('idpengadaan', function ($query) {
            $query->select('idpengadaan')->from('penerimaan');
        })
        ->get();

    return view('transaction.penerimaan.create-penerimaan', compact('pengadaans'));
}

    public function getDetailPenerimaan($id_pengadaan)
    {
        $detailPenerimaan = PenerimaanModel::where('idpengadaan', $id_pengadaan)->get();

        return response()->json($detailPenerimaan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function terimaPengadaan(Request $request)
{
    // Check if the user is authenticated
    if (auth()->check()) {
        // Mendapatkan data dari request
        $idPengadaan = $request->input('idpengadaan'); // Use the correct name based on the form input
        $idUser = auth()->user()->iduser;

        // Panggil stored procedure
        $result = DB::select('CALL TerimaPengadaan(?, ?)', [
            $idPengadaan, $idUser
        ]);

        // Redirect atau berikan respons sesuai kebutuhan Anda
        return redirect()->route('data-penerimaan', compact('result'));
    }
}

public function detail($id)
{
    $detailPenerimaan = DB::table('detail_penerimaan as d')
        ->select('d.*', 'b.nama')
        ->join('barang as b', 'b.idbarang', '=', 'd.barang_idbarang')
        ->where('d.idpenerimaan', '=', $id)
        ->get();

    return response()->json($detailPenerimaan);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
