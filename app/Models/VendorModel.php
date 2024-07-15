<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorModel extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at']; 
    use SoftDeletes;
    protected $table = 'vendor';
    protected $primaryKey = 'id_vendor';


    public $timestamps = false;

    public function vendor()
    {
        return $this->belongsTo(BadanHukum::class);
    }

    public function pengadaan()
    {
        return $this->hasMany(PengadaanModel::class);
    }
}
