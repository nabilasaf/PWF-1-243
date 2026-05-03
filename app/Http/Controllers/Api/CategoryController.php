<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();

        return response()->json([
            'message' => 'Data category',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $data = Category::create([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Berhasil tambah category',
            'data' => $data
        ], 201);
    }

    public function show($id)
    {
        $data = Category::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $data = Category::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data->update([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Berhasil update',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $data = Category::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'message' => 'Berhasil dihapus'
        ], 204);
    }
}