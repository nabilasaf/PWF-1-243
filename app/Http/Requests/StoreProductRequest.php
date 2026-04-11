<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan melakukan request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk menyimpan produk baru.
     */
    public function rules(): array
    {
        return [
            'name'  => 'required|string|max:255',
            'qty'   => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ];
    }

    /**
     * Pesan error kustom (bahasa Indonesia).
     */
    public function messages(): array
    {
        return [
            'name.required'  => 'Nama produk wajib diisi.',
            'name.string'    => 'Nama produk harus berupa teks.',
            'name.max'       => 'Nama produk tidak boleh lebih dari 255 karakter.',

            'qty.required'   => 'Jumlah (kuantitas) produk wajib diisi.',
            'qty.integer'    => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).',
            'qty.min'        => 'Jumlah produk minimal adalah 1.',

            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric'  => 'Harga produk harus berupa angka yang valid.',
            'price.min'      => 'Harga produk tidak boleh kurang dari 0.',
        ];
    }

    /**
     * Nama field yang lebih mudah dibaca pada pesan error default.
     */
    public function attributes(): array
    {
        return [
            'name'  => 'nama produk',
            'qty'   => 'jumlah',
            'price' => 'harga',
        ];
    }
}