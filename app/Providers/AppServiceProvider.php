<?php

namespace App\Providers;

use App\Http\Observers\ArticleObserver;
use App\Models\ArticleModel;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
//        ArticleModel::observe(ArticleObserver::class);
    }

    /**
     * RegisterRequest any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
