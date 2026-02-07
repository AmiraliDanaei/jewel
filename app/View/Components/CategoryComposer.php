<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class CategoryComposer extends Component
{
    public function compose(View $view): void
{
   
    $categories = Category::all();
    
    $wishlistCount = 0;
   
    if (auth()->check()) {
       
        $wishlistCount = auth()->user()->wishlist()->count();
    }
    
    
    $view->with('categories', $categories)
         ->with('wishlistCount', $wishlistCount);
}

}
