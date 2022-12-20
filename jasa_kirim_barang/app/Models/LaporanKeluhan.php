<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeluhan extends Model
{
    use HasFactory;

    /**
    * fillable
    *
    * @var array
    */

    protected $fillable = [
        'id_barang',
        'keluhan',
    ];

    public function pengiriman_barang(){
        return $this->belongsTo(PengirimanBarang::class, 'id_barang', 'id');
    }
}
