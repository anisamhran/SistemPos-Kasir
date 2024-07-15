<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BarangModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount = User::count();
        $users = User::all();
        $barangCount = BarangModel::count();
        $barangs = BarangModel::all();
        // $userCount = User::count();
        // $users = User::all();
        // $userCount = User::count();
        // $users = User::all();
        return view('dashboard', compact('userCount', 'users','barangCount', 'barangs'));
    }
}
