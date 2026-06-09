<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CategoryController
{
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::with('category')->where('category_id', $id)->get();
        $categories = $this->buildTree();
        return view('categories.show', compact('category', 'products', 'categories'));
    }

    private function buildTree()
    {
        $all = Category::all();
        $indexed = $all->keyBy('id');
        $tree = collect();

        foreach ($indexed as $cat) {
            if (is_null($cat->parent_id)) {
                $tree->push($cat);
            } else {
                $indexed[$cat->parent_id]->children_loaded[] = $cat;
            }
        }

        return $tree;
    }
}