<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Predefined categories with images
    private $predefinedCategories = [
        'Laptops' => 'https://images.unsplash.com/photo-1593640408182-31c70c8268f5?w=300&h=200&fit=crop',
        'Mobiles' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=300&h=200&fit=crop',
        'Computers' => 'https://images.unsplash.com/photo-1587202372634-32705e3bf49c?w=300&h=200&fit=crop',
        'Accessories' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300&h=200&fit=crop'
    ];

    // Predefined brands
    private $predefinedBrands = [
        'Dell', 'HP', 'Lenovo', 'Apple', 'Samsung', 
        'Asus', 'Acer', 'Microsoft', 'Sony', 'Toshiba',
        'LG', 'Google', 'OnePlus', 'Xiaomi', 'Huawei'
    ];

    public function home()
    {
        $featuredProducts = Product::latest()->take(8)->get();
        return view('welcome', compact('featuredProducts'))->with('categories', $this->predefinedCategories);
    }

    public function index(Request $request)
    {
        $query = Product::query();
        
        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        // Brand filter
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }
        
        // Search filter
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('description', 'like', '%'.$request->search.'%')
                  ->orWhere('brand', 'like', '%'.$request->search.'%');
            });
        }
        
        $products = $query->latest()->paginate(12);
        
        // Use predefined categories and brands, not from database
        $allCategories = array_keys($this->predefinedCategories);
        $allBrands = $this->predefinedBrands;
        
        return view('products.index', compact('products', 'allCategories', 'allBrands'));
    }

    public function create()
    {
        return view('products.create', [
            'brands' => $this->predefinedBrands,
            'categories' => array_keys($this->predefinedCategories)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255|in:' . implode(',', $this->predefinedBrands),
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255|in:' . implode(',', array_keys($this->predefinedCategories)),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Get or create a default user
        $user = Auth::user();
        if (!$user) {
            $user = \App\Models\User::first();
            if (!$user) {
                $user = \App\Models\User::create([
                    'name' => 'Admin User',
                    'email' => 'admin@example.com',
                    'password' => bcrypt('password123'),
                ]);
            }
        }

        Product::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'image' => $imagePath,
            'user_id' => $user->id,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
            'brands' => $this->predefinedBrands,
            'categories' => array_keys($this->predefinedCategories)
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255|in:' . implode(',', $this->predefinedBrands),
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255|in:' . implode(',', array_keys($this->predefinedCategories)),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}