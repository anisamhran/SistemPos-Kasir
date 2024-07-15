<?php

namespace App\Http\Controllers;

use App\Models\BadanHukum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BadanHukumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lastId = BadanHukum::max('id_badan_hukum');

        // Menambahkan 1 untuk mendapatkan ID baru
        $newlyCreatedId = $lastId + 1;
        $badanhukum = BadanHukum::whereNull('deleted_at')->get();
        return view('master.badanhukum.data-badanhukum',compact('badanhukum','newlyCreatedId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastId = BadanHukum::max('id_badan_hukum');

        // Menambahkan 1 untuk mendapatkan ID baru
        $newlyCreatedId = $lastId + 1;
        return view('master.badanhukum.create-badanhukum',compact('newlyCreatedId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('badan_hukum')->insert([
            'namabadan_hukum' => $request->input('namabadan_hukum'),
        ]);

        return redirect()->route('data-badan-hukum')->with('success', 'Data badanhukum berhasil disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_badan_hukum)
    {
        $badanhukum = DB::table('badan_hukum')->where('id_badan_hukum', $id_badan_hukum)->first();
        return view('master.badanhukum.edit-badanhukum', compact('badanhukum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_badan_hukum)
    {
        $badanhukum = BadanHukum::find($id_badan_hukum);

        DB::table('badan_hukum')
        ->where('id_badan_hukum', $id_badan_hukum)
        ->update([
            'namabadan_hukum' =>$request->input('namabadan_hukum'),
        ]);

        return redirect()->route('data-badan-hukum', compact('badanhukum'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_badan_hukum)
    {
        $badanhukum = BadanHukum::find($id_badan_hukum);
        $badanhukum->delete();  
    
        return redirect()->route('data-badan-hukum')->with('success', 'Data badanhukum berhasil dihapus secara permanen');
    }
    
        
    public function onlyTrashed()
    {
        $trashes = BadanHukum::onlyTrashed()->get();
        return view('master.badanhukum.deleted-badanhukum', compact('trashes'));
    }
    
    public function deleted()
    {
        $trashes = BadanHukum::withTrashed()->whereNotNull('deleted_at')->get();
        return view('master.badanhukum.deleted-badanhukum', compact('trashes'));
    }
    
        
            public function restore($id_badan_hukum)
            {
                DB::table('badan_hukum')
                    ->where('id_badan_hukum', $id_badan_hukum)
                    ->update(['deleted_at' => null]);
        
                return redirect()->route('data-badan-hukum')->with('success', 'Data badanhukum berhasil dikembalikan');
            }
}
