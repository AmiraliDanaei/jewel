<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class HeaderDataComposer
{
    public function compose(View $view): void
    {
        $wishlistCount = 0;
        
        if (auth()->check()) {
            $wishlistCount = auth()->user()->wishlist()->count();
        }
        
        $view->with('categories', Category::all())
             ->with('wishlistCount', $wishlistCount);
    }
}
