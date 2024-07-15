<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangModel extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at']; 
    use SoftDeletes;
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

     public $timestamps = false;

    public function satuan()
    {
        return $this->belongsTo(SatuanModel::class, 'idsatuan','idsatuan');
    }
    public function jenis_barang()
    {
        return $this->belongsTo(JenisBarang::class, 'id_jenis_barang','id_jenis_barang');
    }

    public function stok()
    {
        return $this->hasMany(StokModel::class);
    }

    public function detailPengadaan()
    {
        return $this->hasMany(DetailPengadaanModel::class);
    }


}
