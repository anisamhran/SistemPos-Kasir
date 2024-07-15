<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{

    public function index()
    {
        $users = User::whereNull('user_table.deleted_at') 
            ->join('role', 'user_table.idrole', '=', 'role.idrole')
            ->select('user_table.*', 'role.nama_role as nama_role')
            ->get();
    
        return view('master.user.data-user', compact('users'));
    }
    

    public function create()
    {
        $lastId = User::max('iduser');
        // Menambahkan 1 untuk mendapatkan ID baru
        $newlyCreatedId = $lastId + 1;
        $roles = DB::table('role')->get();
        return view('master.user.create-user', compact('roles', 'newlyCreatedId'));
    }

    public function store(Request $request)
    {
        DB::table('user_table')->insert([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'idrole' => $request->input('idrole'),
        ]);

        return redirect()->route('data-user')->with('success', 'Data user berhasil disimpan');
    }

    public function edit($iduser)
    {
        $user = DB::table('user_table')
            ->join('role', 'user_table.idrole', '=', 'role.idrole')
            ->select('user_table.*', 'role.nama_role as role_nama')
            ->where('user_table.iduser', $iduser)
            ->first();

        $roles = DB::table('role')->get();
        return view('master.user.edit-user', compact('user', 'roles'));
    }

    public function update(Request $request, $idrole)
    {
        DB::table('user_table')
            ->where('iduser', $idrole)
            ->update([
                'idrole' => $request->input('idrole'),
                'password' => $request->input('password'),
                'username' => $request->input('username'),
            ]);

        return redirect()->route('data-user');
    }

    public function onlyTrashed()
    {
        $trashes = DB::table('user_table')
            ->whereNotNull('deleted_at')
            ->get();

        return view('master.user.deleted-satuan', compact('trashes'));
    }

    public function destroy($iduser)
    {
        $user = User::find($iduser);
        $user->delete();

        return redirect()->route('data-user-dihapus')->with('success', 'Data user berhasil dihapus');
    }

    public function deleted()
    {
        $trashes = User::onlyTrashed()
            ->join('role', 'user_table.idrole', '=', 'role.idrole')
            ->select('user.*', 'role.nama_role as nama_role')
            ->get();
    
        return view('master.user.deleted-user', compact('trashes'));
    }
    
    public function restore($iduser)
    {
        DB::table('user_table')->where('iduser', $iduser)->update(['deleted_at' => null]);

        return redirect()->route('data-user')->with('success', 'Data user berhasil dikembalikan');
    }

    
}