<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $stokBarangs = StokModel::all();

        return view('transaction.stok.data-stok', compact('stokBarangs'));
    }
}
