<?php

namespace App\Providers;

use App\Http\Services\ProductService;
use App\Models\Category;
use App\View\Composers\HeaderComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer('client.component.header',HeaderComposer::class);
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
