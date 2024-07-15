<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarginPenjualanModel extends Model
{
    use HasFactory;

    protected $table = 'margin_penjualan';

    public function penjualan()
    {
        return $this->belongsTo(PenjualanModel::class);
    }

    public function barang()
    {
        return $this->belongsTo(BarangModel::class);
    }
}
