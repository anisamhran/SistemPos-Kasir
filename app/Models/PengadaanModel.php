<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengadaanModel extends Model
{
    use HasFactory;

    protected $table = 'pengadaan';

    public function vendor()
    {
        return $this->belongsTo(VendorModel::class,'vendor_idvendor', 'idvendor');
    }

    public function detailPengadaan()
    {
        return $this->hasMany(DetailPengadaanModel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
