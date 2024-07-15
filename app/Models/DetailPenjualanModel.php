<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualanModel extends Model
{
    use HasFactory;

    protected $table = 'detail_penjualan';

    public function barang()
    {
        return $this->belongsTo(BarangModel::class);
    }

    public function penjualan()
    {
        return $this->belongsTo(PenjualanModel::class);
    }
}
