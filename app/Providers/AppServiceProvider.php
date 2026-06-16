<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        View::composer('layouts.main', function ($view) {
            $all = Category::all();
            $categories = $this->buildTree($all);
            $view->with('categories', $categories);
        });
    }

    private function buildTree($all, $parentId = null)
    {
        return $all->filter(fn($c) => $c->parent_id === $parentId)
            ->map(function ($c) use ($all) {
                $c->children_tree = $this->buildTree($all, $c->id);
                return $c;
            })->values();
    }
}
