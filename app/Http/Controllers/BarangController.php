<?php

    namespace App\Http\Controllers;


    use App\Models\BarangModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    class BarangController extends Controller
    {

        public function index()
        {
            $barangs = BarangModel::whereNull('barang.deleted_at') // Specify the table name
                ->join('satuan', 'barang.idsatuan', '=', 'satuan.idsatuan')
                ->join('jenis_barang', 'barang.id_jenis_barang', '=', 'jenis_barang.id_jenis_barang')
                ->select('barang.*', 'satuan.nama_satuan as nama_satuan', 'jenis_barang.nama_jenis as nama_jenis')
                ->get();
        
            return view('master.barang.data-barang', compact('barangs'));
        }
        
        


        public function create()
        {
            $lastId = BarangModel::max('idsatuan');
            // Menambahkan 1 untuk mendapatkan ID baru
            $newlyCreatedId = $lastId + 1;
            $satuans = DB::table('satuan')->get();
            $jenis_barang = DB::table('jenis_barang')->get();
            return view('master.barang.create-barang', compact('satuans','jenis_barang', 'newlyCreatedId'));
        }

        public function store(Request $request)
        {
            DB::table('barang')->insert([
                'nama' => $request->input('nama'),
                'id_jenis_barang' => $request->input('jenis_barang'),
                'idsatuan' => $request->input('idsatuan'),
                'harga' => $request->input('harga'),
                'status' => $request->input('status'),
            ]);

            return redirect()->route('data-barang')->with('success', 'Data barang berhasil disimpan');
        }

        public function edit($idbarang)
        {
            $barang = DB::table('barang')
                ->join('satuan', 'barang.idsatuan', '=', 'satuan.idsatuan')
                ->join('jenis_barang', 'barang.id_jenis_barang', '=', 'jenis_barang.id_jenis_barang')
                ->select('barang.*', 'satuan.nama_satuan as nama_satuan', 'jenis_barang.nama_jenis as nama_jenis')
                ->where('barang.idbarang', $idbarang)
                ->first();

            $satuans = DB::table('satuan')->get();
            $jenis_barang = DB::table('jenis_barang')->get();
            return view('master.barang.edit-barang', compact('barang', 'satuans', 'jenis_barang'));
        }

        public function update(Request $request, $id)
        {
            DB::table('barang')
                ->where('idbarang', $id)
                ->update([
                    'nama' => $request->input('nama'),
                    'id_jenis_barang' => $request->input('jenis_barang'),
                    'idsatuan' => $request->input('idsatuan'),
                    'harga' => $request->input('harga'),
                    'status' => $request->input('status'),
                ]);

            return redirect()->route('data-barang')->with('success', 'Data barang berhasil diperbarui');
        }
        public function destroy($idbarang)
{
    DB::table('barang')->where('idbarang', $idbarang)->update(['deleted_at' => now()]);

    return redirect()->route('data-barang-dihapus')->with('success', 'Data barang berhasil dihapus');
}
public function deleted()
{
    $trashes = BarangModel::withTrashed()
        ->join('satuan', 'barang.idsatuan', '=', 'satuan.idsatuan')
        ->join('jenis_barang', 'barang.id_jenis_barang', '=', 'jenis_barang.id_jenis_barang')
        ->select('barang.*', 'satuan.nama_satuan', 'jenis_barang.nama_jenis')
        ->whereNotNull('barang.deleted_at')
        ->get();

    return view('master.barang.deleted-data', compact('trashes'));
}


        public function restore($idbarang)
        {
            DB::table('barang')->where('idbarang', $idbarang)->update(['deleted_at' => null]);

            return redirect()->route('data-barang')->with('success', 'Data barang berhasil dikembalikan');
        }

        
    }
?>