<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenerimaanModel extends Model
{
    use HasFactory;
    protected $table = 'detail_penerimaan';

    public function barang()
    {
        return $this->belongsTo(BarangModel::class);
    }

    public function penerimaan()
    {
        return $this->belongsTo(PenerimaanModel::class);
    }

    
}
