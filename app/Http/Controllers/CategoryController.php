<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        // $categories = Category::all();
        // $categories = DB::table('categories')->orderBy('created_at', 'desc')->get();
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('admin.list-category', compact('categories'));
    }

    public function create()
    {
        return view('admin.add-category');
    }

    public function store(Request $req)
    {
        $cat_obj = new Category;

        $req->validate([
            'category_name' => 'required|unique:categories|max:50'
        ]);
        
        $cat_obj->category_name = $req->post('category_name');
        $cat_obj->save();

        // Category::create($valid_data);
        // $req->session()->flash('success', 'Category is Created Successfully!');
        return redirect()->route('category.index')->with('success', 'Category is Created Successfully!');
    }

    public function edit($category_id)
    {
        $category = Category::find($category_id);
        $cat_id = $category->id;
        $cat_name = $category->category_name;
        return view('admin.edit-category', compact('cat_id', 'cat_name'));
    }

    public function update(Request $req, $category_id)
    {
        $valid_data = $req->validate([
            'category_name' => 'required|unique:categories'
        ]);

        Category::find($category_id)->update($valid_data);

        $req->session()->flash('success', 'Category is Updated Successfully!');
        return redirect()->route('category.index');
    }

    public function destroy(Request $req, $category)
    {
        $category = Category::find($category);
        $category_name = $category->category_name;
        $category->delete();
        $req->session()->flash('success', "Category \"$category_name\" has Deleted Successfully...");
        return redirect()->back();
    }
}
