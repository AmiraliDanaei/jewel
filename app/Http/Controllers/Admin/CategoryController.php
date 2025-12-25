<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::withCount('products')->get();
        return view('admin.categories.index', compact('categories'));
    }
    public function create() { return view('admin.categories.create'); }
    public function store(Request $request) {
        $validated = $request->validate(['name' => 'required|string|unique:categories|max:255']);
        Category::create($validated);
        return redirect()->route('admin.categories.index')->with('success', 'دسته‌بندی با موفقیت ساخته شد.');
    }
    public function edit(Category $category) { return view('admin.categories.edit', compact('category')); }
    public function update(Request $request, Category $category) {
        $validated = $request->validate(['name' => 'required|string|max:255|unique:categories,name,'.$category->id]);
        $category->update($validated);
        return redirect()->route('admin.categories.index')->with('success', 'دسته‌بندی با موفقیت آپدیت شد.');
    }
    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'دسته‌بندی با موفقیت حذف شد.');
    }
}
