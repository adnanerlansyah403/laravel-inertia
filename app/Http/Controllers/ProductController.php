<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

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
}
