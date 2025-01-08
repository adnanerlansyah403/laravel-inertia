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
        $products = $query->latest()->paginate(10)->withQueryString();

        // Fetch categories (if you want to retrieve all categories)
        $categories = Category::all();

        return Inertia::render("Products/Index", [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('products', 'public');
        }

        Product::create($data);

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
