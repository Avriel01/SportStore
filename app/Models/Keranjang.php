<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['data_barang'];

    protected $hidden = ['id'];

    // protected $casts =  ['data_barang' => 'array'];

    // protected $attributes = [
    //     'data_barang' => [],
    // ];
}