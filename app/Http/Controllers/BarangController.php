<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = barang::all();

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
        $table = new barang();
        $table->title = $request->title;
        $table->description = $request->description;
        $table->jenis = $request->jenis;
        $table->harga = $request->harga;
        $table->jumlah_suka_barang = $request->jumlah_suka_barang;
        $table->kode_barang = $request->kode_barang;
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
        $table = barang::find($id);
        if($table) {
            return $table;
        }else {
            return ['message' => 'Data not found'];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $table = Barang::find($id);
        if($table) {
            $table->title = $request->title ? $request->title : $table->title;
            $table->description = $request->description ? $request->description : $table->description;
            $table->jenis = $request->jenis ? $request->jenis : $table->jenis;
            $table->harga = $request->harga ? $request->harga : $table->harga;
            $table->kode_barang = $request->kode_barang ? $request->kode_barang : $table->kode_barang;
            $table->save();

            return $table;
        }else {
            return ['message' => 'Data not found'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Barang::find($id);
        if($table) {
            $table->delete();
            return ['message' => 'Delete success'];
        }else {
            return ['message' => 'Data not found'];
        }
    }
    public function like($id)
    {
        $table = Barang::find($id);
        $table->jumlah_suka_barang++;
        $table->save();

        return $table;
    }
}
