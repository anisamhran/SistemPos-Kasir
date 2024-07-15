<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanModel extends Model
{
    use HasFactory;

    protected $table = 'penerimaan';

    public function vendor()
    {
        return $this->belongsTo(VendorModel::class);
    }

    public function detailPenerimaan()
    {
        return $this->hasMany(DetailPenerimaanModel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
