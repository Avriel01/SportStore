<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['title', 'description', 'jenis', 'harga', 'kode_barang', 'jumlah_suka_barang'];
}

