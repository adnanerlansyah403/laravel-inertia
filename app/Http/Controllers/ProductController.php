<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Start the query with eager loading
        $query = Product::with(['category', 'reviews']);

        // Apply the search filter if the 'search' parameter exists
        if ($request->has('search')) $query->where('name', 'like', '%' . $request->search . '%');
        if ($request->has('category')) $query->whereHas('category', function ($query) use ($request) {
            $query->where('id', $request->category); // Filter berdasarkan category_id
        });

        // Paginate the results
        $products = $query->paginate(10);

        // Fetch categories (if you want to retrieve all categories)
        $categories = Category::all();

        return Inertia::render("Products/Index", [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function store(ProductRequest $request)
    {
        // $validated = $request->validate([
        //     'category_id' => 'required|exists:categories,id',
        //     'name' => 'required|max:255',
        //     'description' => 'required',
        //     'price' => 'required',
        //     'image_url' => 'nullable|url'
        // ], [
        //     '*.required' => ":attribute wajib di isi.",
        //     '*.url' => ':attribute harus berupa link url.'
        // ], [
        //     'name' => 'Nama',
        //     'category_id' => 'Kategori',
        //     'price' => 'Harga',
        //     'description' => 'Deskripsi',
        //     'image_url' => 'Gambar'
        // ]);

        $data = $request->validated();

        dd($data);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('message', 'Produk berhasil dibuat!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return Inertia::render('Products/Edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('message', 'Produk berhasil diperbarui');

    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('projects.index')
            ->with('message', 'Produk berhasil di hapus');
    }


}
