<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenerimaanModel;
use App\Models\ReturModel;
use Illuminate\Support\Facades\DB;

class ReturController extends Controller
{

    public function index()
    {
        $returns = ReturModel::all();
        
        return view('transaction.retur.data-retur', ['returns' => $returns]);
    }

    public function create()
    {
        $penerimaans =PenerimaanModel::where('status', 1)
        ->whereNotIn('idpenerimaan', function ($query) {
            $query->select('idpenerimaan')->from('retur');
        })
        ->get();

    return view('transaction.retur.create-retur', compact('penerimaans'));
    }


    public function addretur(Request $request)
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // Get data from the request
            $idpenerimaan = $request->input('idpenerimaan');
            $alasan = $request->input('alasan');
            $idUser = auth()->user()->iduser;
    
            // You need to modify this part based on how you get 'jumlah' and 'iddetail_penerimaan' from your form.
            $iddetail_penerimaan = $request->input('iddetail_penerimaan');
    
            // Call stored procedure
            $result = DB::select('CALL tambah_retur(?,?,?,?)', [
                $idpenerimaan, $idUser, $alasan, $iddetail_penerimaan
            ]);
    
            // Redirect or provide the response as needed
            return redirect()->route('data-retur', compact('result'));
        }
    }
    

    public function detail($idretur)
    {
        $detailPenerimaan = DB::table('detail_retur as d')
        ->select('d.*', 'dp.*')
        ->join('detail_penerimaan as dp', 'dp.iddetail_penerimaan', '=', 'd.iddetail_penerimaan')
        ->where('d.idretur', '=', $idretur)
        ->get();

    return response()->json($detailPenerimaan);
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
