<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $products = Product::with('user')->paginate(10);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        return view('product.create', compact('users', 'categories'));
    }

    // ✅ STORE (pakai Form Request)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'nullable|exists:category,id',
            'qty'         => 'required|integer|min:1',
            'price'       => 'required|numeric|min:0',
        ], [
            'name.required'  => 'Nama produk wajib diisi.',
            'name.max'       => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'qty.required'   => 'Jumlah (kuantitas) produk wajib diisi.',
            'qty.integer'    => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).',
            'qty.min'        => 'Jumlah produk minimal adalah 1.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric'  => 'Harga produk harus berupa angka yang valid.',
            'price.min'      => 'Harga produk tidak boleh kurang dari 0.',
        ]);

        $validated['user_id'] = Auth::id();

        try {
            Product::create($validated);

            return redirect()
                ->route('product.index')
                ->with('success', 'Product created successfully.');

        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Product store database error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Database error while creating product.');

        } catch (\Throwable $e) {
            Log::error('Product store unexpected error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Unexpected error occurred.');
        }
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.view', compact('product'));
    }

    public function edit(Product $product)
    {
        $users = User::all();
        return view('product.edit', compact('product', 'users'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $this->authorize('update', $product);

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'qty'   => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ], [
            'name.required'  => 'Nama produk wajib diisi.',
            'name.max'       => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'qty.required'   => 'Jumlah (kuantitas) produk wajib diisi.',
            'qty.integer'    => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).',
            'qty.min'        => 'Jumlah produk minimal adalah 1.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric'  => 'Harga produk harus berupa angka yang valid.',
            'price.min'      => 'Harga produk tidak boleh kurang dari 0.',
        ]);

        try {
            $product->fill($validated);

            if (!$product->isDirty()) {
                return redirect()
                    ->back()
                    ->with('warning', 'Tidak ada perubahan data yang dilakukan.');
            }

            $product->save();

            return redirect()
                ->route('product.index')
                ->with('success', 'Product updated successfully.');

        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Product update database error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Database error while updating product.');

        } catch (\Throwable $e) {
            Log::error('Product update unexpected error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Unexpected error occurred.');
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Optional (kalau pakai policy)
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Product berhasil dihapus');
    }

    /**
     * Export semua produk ke CSV (hanya admin — Gate: export-product)
     */
    public function export()
    {
        $products = Product::with('user')->get();

        $filename = 'products_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($products) {
            $handle = fopen('php://output', 'w');

            // Header baris
            fputcsv($handle, ['ID', 'Nama Produk', 'Qty', 'Harga (Rp)', 'Pemilik', 'Dibuat Pada']);

            foreach ($products as $product) {
                fputcsv($handle, [
                    $product->id,
                    $product->name,
                    $product->qty,
                    $product->price,
                    $product->user->name ?? '-',
                    $product->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}