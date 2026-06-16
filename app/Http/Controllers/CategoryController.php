<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id, Request $request)
    {
        $category = Category::findOrFail($id);

        $sortColumn = in_array($request->sort, ['name', 'price', 'quantity']) ? $request->sort : 'name';
        $sortDir = $request->dir === 'desc' ? 'desc' : 'asc';

        $categoryIds = $this->getAllDescendantIds(Category::all(), (int) $id);

        $products = Product::with('category')
            ->whereIn('category_id', $categoryIds)
            ->orderBy($sortColumn, $sortDir)
            ->get();

        return view('categories.show', compact('category', 'products', 'sortColumn', 'sortDir'));
    }

    private function getAllDescendantIds($all, $parentId)
    {
        $ids = [$parentId];
        foreach ($all->where('parent_id', $parentId) as $child) {
            $ids = array_merge($ids, $this->getAllDescendantIds($all, $child->id));
        }
        return $ids;
    }
}
