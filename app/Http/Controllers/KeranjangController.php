<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\barang;

class KeranjangController extends Controller
{
    public function destroy($id)
    {
        $table = Keranjang::find($id);
        if($table) {
            $table->delete();
            return ['message' => 'Delete success'];
        }else {
            return ['message' => 'Data not found'];
        }
    }
    public function store(Request $request, $id)
    {
        $barang = barang::find($id);
        
        $table = new Keranjang();
        $table->data_barang = json_encode($barangArr);
        $table->save();

        // return $table;
        return response()->json([
            'message' => 'Store success',
            'data' => $table
        ], 201);
    }
    public function index()
    {
        $data = Keranjang::all();

        // return $data;
        return response()->json([
            'message' => 'Load data success',
            'data' => $data
        ], 200);
    }
}
