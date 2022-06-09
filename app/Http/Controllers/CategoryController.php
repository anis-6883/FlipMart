<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.list-category', compact('categories'));
    }

    public function create()
    {
        return view('admin.add-category');
    }

    public function store(Request $req)
    {
        $req->validate([
            'category_name' => 'required|unique:categories|max:50'
        ]);
        
        $cat_obj = new Category;
        $cat_obj->category_name = $req->post('category_name');
        $cat_obj->category_order = $req->post('category_order');
        $cat_obj->save();

        // Category::create($valid_data);
        // $req->session()->flash('success', 'Category is Created Successfully!');
        return redirect()->route('category.index')->with('success', 'Category is Created Successfully!');
    }

    public function edit($category_id)
    {
        $category = Category::find($category_id);
        return view('admin.edit-category', compact('category'));
    }

    public function update(Request $req, $category_id)
    {
        $category = Category::find($category_id);

        $isExist = Category::where([
            ['category_name', $req->category_name], 
            ['category_order', $req->category_order]
            ])->exists();

        if($isExist)
            return back()->withErrors(['isExist' => 'The category name has already been taken.']);

        $category->category_name = $req->category_name;
        $category->category_order = $req->category_order;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Category is Updated Successfully!');
    }

    public function destroy($category_id)
    {
        $category = Category::find($category_id);
        $category_name = $category->category_name;
        $category->delete();
        return redirect()->back()->with('success', "Category \"$category_name\" has Deleted Successfully...");
    }
}
