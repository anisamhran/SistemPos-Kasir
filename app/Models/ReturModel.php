<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturModel extends Model
{
    use HasFactory;

    protected $table = 'retur';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailRetur()
    {
        return $this->hasMany(DetailReturModel::class);
    }
}
