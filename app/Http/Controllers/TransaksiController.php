<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaksi;
use App\Models\barang;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Transaksi::all();

        // return $data;
        return response()->json([
            'message' => 'Load data success',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barang = barang::find($request->id_barang);
        $table = new Transaksi();
        $table->id_user = $request->user()->id;
        $table->id_barang = $request->id_barang;
        $table->title = $barang->title;
        $table->jumlah_beli = $request->jumlah_beli;
        $table->harga = $barang->harga * $request->jumlah_beli;
        $table->kode_barang = $barang->kode_barang;
        $table->bayar = false;
        $table->save();

        // return $table;
        return response()->json([
            'message' => 'Store success',
            'data' => $table
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = Transaksi::find($id);
        if($table) {
            return $table;
        }else {
            return ['message' => 'Data not found'];
        }
    }

    public function bayar($id) 
    {
        $table = Transaksi::find($id);
        $table->bayar = true;
        $table->save();

        return $table;
    }

}
