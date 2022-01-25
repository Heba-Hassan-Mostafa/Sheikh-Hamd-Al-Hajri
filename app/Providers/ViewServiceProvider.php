<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //   view()->composer('*', function ($view) {


        //     if (!Cache::has('global_categories'))
        //     {
        //         $global_categories=Category::whereStatus(1)->orderBy('id','desc')->get();

        //         Cache::remember('global_categories', 3600, function () use($global_categories){
        //             return $global_categories;
        //         });

        //     }
        //     $global_categories= Cache::get('global_categories');


        //     $view->with([
        //         'global_categories' => $global_categories
        //     ]);

        // });
    }
}