<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Category List Page
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.list-category', compact('categories'));
    }

    // Category Create Page
    public function create()
    {
        return view('backend.add-category');
    }

    // Store Category
    public function store(Request $req)
    {
        $req->validate([
            'category_name' => 'required|unique:categories|max:50'
        ]);
        
        $obj = new Category;
        $obj->category_name = $req->category_name;
        $obj->category_order = $req->category_order;
        $obj->save();
        // Category::create($valid_data);

        session()->flash('success', 'Category is Created Successfully!');
        return redirect()->route('category.index');
    }

    // Category Edit Page
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.edit-category', compact('category'));
    }

    // Update Category
    public function update(Request $req, $id)
    {
        $category = Category::findOrFail($id);

        $req->validate([
            'category_name' => 'required'
        ]);

        $isExist = Category::where([
            ['category_name', $req->category_name], 
            ['category_order', $req->category_order]
            ])->exists();

        if($isExist)
            return back()->withErrors(['isExist' => 'The category name has already been taken.']);

        $category->category_name = $req->category_name;
        $category->category_order = $req->category_order;
        $category->save();

        session()->flash('success', 'Category is Updated Successfully!');
        return redirect()->route('category.index');
    }

    // Detele Category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $cat_name = $category->category_name;
        $category->delete();
        session()->flash('success', "Category \"$cat_name\" has Deleted Successfully...");
        return redirect()->back();
    }
}
