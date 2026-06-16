<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:45',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        Category::create($data);
        return redirect()->route('admin.index');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('admin.index');
    }

    public function edit($id){

    }
}