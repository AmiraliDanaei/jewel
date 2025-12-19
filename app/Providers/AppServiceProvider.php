<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use App\View\Composers\CategoryComposer; 

class AppServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        
    }

    
    public function boot(): void
    {
       
        View::composer('layouts.partials.header', CategoryComposer::class);
    }
}
