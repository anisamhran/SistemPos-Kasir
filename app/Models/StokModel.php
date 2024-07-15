<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokModel extends Model
{
    use HasFactory;

    
    protected $table = 'v_stok_barang';
    
    protected $primaryKey = 'idbarang';

    public $incrementing = false;
    public $timestamps = false;

    public function barang()
    {
        return $this->belongsTo(BarangModel::class);
    }
}
