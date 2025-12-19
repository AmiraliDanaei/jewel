<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $fileNameToStore = 'default.jpg';
        if ($request->hasFile('image')) {
            $filename = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanedFilename = Str::slug($filename);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $cleanedFilename . '_' . time() . '.' . $extension;
            $request->file('image')->move(public_path('products'), $fileNameToStore);
        }

        $validatedData['image'] = $fileNameToStore;
        Product::create($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'محصول جدید با موفقیت اضافه شد!');
    }

    
    public function show(Product $product)
    {
       
        return view('admin.products.show', compact('product'));
    }

    
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

   
    public function update(Request $request, Product $product)
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
            if ($product->image && $product->image != 'default.jpg' && file_exists(public_path('products/' . $product->image))) {
                unlink(public_path('products/' . $product->image));
            }

            $filename = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanedFilename = Str::slug($filename);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $cleanedFilename . '_' . time() . '.' . $extension;
            $request->file('image')->move(public_path('products'), $fileNameToStore);
            $validatedData['image'] = $fileNameToStore;
        }

        $product->update($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'محصول با موفقیت آپدیت شد!');
    }

    
    public function destroy(Product $product)
    {
        if ($product->image && $product->image != 'default.jpg' && file_exists(public_path('products/' . $product->image))) {
            unlink(public_path('products/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'محصول با موفقیت حذف شد!');
    }
}
