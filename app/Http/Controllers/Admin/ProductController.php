<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10); 
        return view('admin.products.index', compact('products')); 
    }
    
    public function create()
    {
        $categories = Category::all(); 
        return view('admin.products.create', compact('categories')); 
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            
            $path = $request->file('image')->storeAs('public/products', $fileNameToStore);
            
            $validatedData['image'] = $fileNameToStore;
        } else {
            $validatedData['image'] = 'default.jpg';
        }
        
        Product::create($validatedData);
        
        return redirect()->route('products.index')->with('success', 'محصول جدید با موفقیت اضافه شد!');
    }

    
    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        
    }

    
    public function update(Request $request, string $id)
    {
        
    }

    
    public function destroy(string $id)
    {
        
    }
}
