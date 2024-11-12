<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('client.layouts.main-nav', function ($view) {
            $categories = Category::query()->whereNull('parent_id')->where('is_active', '=', 1)->with(['children' => function ($q) {
                $q->where('is_active', '=', 1)->orderBy('name', 'ASC');
            }])->orderBy('name', 'ASC')->get();

            $view->with('categories', $categories);
        });
    }
}
