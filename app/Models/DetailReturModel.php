<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReturModel extends Model
{
    use HasFactory;

    protected $table = 'detail_retur';

    public function barang()
    {
        return $this->belongsTo(BarangModel::class);
    }

    public function retur()
    {
        return $this->belongsTo(ReturModel::class);
    }
}
