<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanBarang extends Model
{
    use HasFactory;

    /**
    * fillable
    *
    * @var array
    */

    protected $fillable = [
        'nama_barang',
        'nama_pengirim',
        'telp_pengirim',
        'berat_barang',
        'jenis_barang',
        'kota_asal',
        'kota_tujuan',
        'estimasi',
        'nama_penerima',
        'telp_penerima',
    ];

}
