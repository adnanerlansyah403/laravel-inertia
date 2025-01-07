<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'image_url' => 'nullable|url|max:2048',
            'is_active' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama produk wajib diisi',
            'price.required' => 'Harga produk wajib diisi',
            'description.required' => 'Deskripsi produk wajib diisi',
            'category_id.required' => 'Kategori produk wajib diisi',
            'category_id.exists' => 'Kategori produk tidak valid',
            'price.numeric' => 'Harga harus berupa angka',
            'stock.integer' => 'Stok harus berupa angka bulat',
            'stock.min' => 'Stok harus lebih dari 0',
            'image.image' => 'File harus berupa gambar',
            'image.max' => 'Ukuran gambar maksimal 2MB'
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'Kategori',
            'name' => 'Nama',
            'price' => 'Harga',
            'description' => 'Deskripsi',
            'image_url' => 'Gambar URL',
            'stock' => 'Stok',
            'is_active' => 'Status',
        ];
    }
}
