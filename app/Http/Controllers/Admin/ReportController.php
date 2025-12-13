<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; 
use Illuminate\Support\Facades\DB; 

class ReportController extends Controller
{
    
    public function popularCategories()
    {
        
        $minProductCount = 2; 

        $categories = Category::withCount('products') 
                                ->having('products_count', '>', $minProductCount) 
                                ->orderBy('products_count', 'desc') 
                                ->get();

        return view('admin.reports.popular_categories', compact('categories'));
    }
}
