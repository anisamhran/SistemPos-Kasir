<?php

namespace App\Http\Controllers;

use App\Models\VendorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
   

    public function index()
{
    $vendors = VendorModel::whereNull('vendor.deleted_at') // Specify the table name
        ->join('badan_hukum', 'vendor.id_badan_hukum', '=', 'badan_hukum.id_badan_hukum')
        ->select('vendor.*', 'badan_hukum.namabadan_hukum')
        ->get();

    return view('master.vendor.data-vendor', compact('vendors'));
}
    
    
    
    
        public function create()
        {
            $badan_hukum = DB::table('badan_hukum')->get();
            $lastId = VendorModel::max('idvendor');
            // Menambahkan 1 untuk mendapatkan ID baru
            $newlyCreatedId = $lastId + 1;
            return view('master.vendor.create-vendor', compact('badan_hukum', 'newlyCreatedId'));
        }
    
        public function store(Request $request)
        {
            DB::table('vendor')->insert([
                'nama_vendor' => $request->input('nama_vendor'),
                'id_badan_hukum' => $request->input('badan_hukum'),
                'status' => $request->input('status'),
            ]);
    
            return redirect()->route('data-vendor')->with('success', 'Data vendor berhasil disimpan');
        }
    
        public function edit($id_vendor)
        {
            $vendor = DB::table('vendor')
            ->join('badan_hukum', 'vendor.id_badan_hukum', '=', 'badan_hukum.id_badan_hukum')
            ->select('vendor.*', 'badan_hukum.namabadan_hukum as namabadan_hukum')
            ->where('vendor.idvendor', $id_vendor)
            ->first();

        $badan_hukum = DB::table('badan_hukum')->get();
        return view('master.vendor.edit-vendor', compact('vendor', 'badan_hukum'));
        }
    
        public function update(Request $request, $id_vendor)
        {
            DB::table('vendor')
                ->where('idvendor', $id_vendor)
                ->update([
                    'nama_vendor' => $request->input('nama_vendor'),
                    'id_badan_hukum' => $request->input('badan_hukum'),
                    'status' => $request->input('status'),
                ]);
    
            return redirect()->route('data-vendor')->with('success', 'Data vendor berhasil diperbarui');
        }
    

        public function destroy($id_vendor)
        {
            DB::table('vendor')->where('idvendor', $id_vendor)->update(['deleted_at' => now()]);
        
            return redirect()->route('data-vendor')->with('success', 'Data vendor berhasil dihapus secara permanen');
        }
    


        public function deleted()
        {
            $trashes = VendorModel::withTrashed()
                ->join('badan_hukum', 'vendor.id_badan_hukum', '=', 'badan_hukum.id_badan_hukum')
                ->select('vendor.*', 'badan_hukum.namabadan_hukum')
                ->whereNotNull('vendor.deleted_at')
                ->get();
        
            return view('master.vendor.deleted-vendor', compact('trashes'));
        }

        
        public function restore($id_vendor)
        {
            DB::table('vendor')
                ->where('idvendor', $id_vendor)
                ->update(['deleted_at' => null]);
    
            return redirect()->route('data-vendor')->with('success', 'Data vendor berhasil dikembalikan');
        }
    }
    

?>  