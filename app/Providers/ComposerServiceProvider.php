<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\HeaderDataComposer; 

class ComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
       
        View::composer('layouts.partials.header', HeaderDataComposer::class);
    }
}
