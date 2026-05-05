<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductApiController extends Controller
{
    // ✅ GET ALL
    public function index()
    {
        $data = Product::all();

        return response()->json([
            'message' => 'Data product',
            'data' => $data
        ], 200);
    }

    // ✅ STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required', // ✅ ditambah
            'category_id' => 'required'
        ]);

        $data = Product::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'price' => $request->price,
            'qty' => $request->qty, // ✅ ditambah
            'category_id' => $request->category_id
        ]);

        return response()->json([
            'message' => 'Berhasil tambah product',
            'data' => $data
        ], 201);
    }

    // ✅ SHOW
    public function show($id)
    {
        $data = Product::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Detail product',
            'data' => $data
        ], 200);
    }

    // ✅ UPDATE
    public function update(Request $request, $id)
    {
        $data = Product::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data->update([
            'name' => $request->name,
            'price' => $request->price,
            'qty' => $request->qty, 
            'category_id' => $request->category_id
        ]);

        return response()->json([
            'message' => 'Berhasil update product',
            'data' => $data
        ], 200);
    }

  
    public function destroy($id)
    {
        $data = Product::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'message' => 'Berhasil dihapus'
        ], 200);
    }
}