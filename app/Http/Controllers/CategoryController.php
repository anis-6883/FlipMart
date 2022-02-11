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
        $categories = DB::table('categories')->orderBy('created_at', 'desc')->get();
        return view('admin.list-category', compact('categories'));
    }

    public function create()
    {
        return view('admin.add-category');
    }

    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function store(Request $req)
    {
        $cat_obj = new Category;

        $req->validate([
            'category_name' => 'required|unique:categories'
        ]);
        
        $cat_obj->category_name = $this->test_input($req->post('category_name'));
        $cat_obj->created_at = date("Y-m-d H:i:s");
        $cat_obj->save();

        // $cat_obj = Category::create([
        //     'category_name' => $this->test_input($req->post('category_name')),
        //     'created_at' => date("Y-m-d H:i:s")
        // ]);

        $req->session()->flash('success', 'Category is Created Successfully!');
        return redirect()->route('category.index');
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
        $req->validate([
            'category_name' => 'required|unique:categories'
        ]);

        // $cat_obj = Category::find($category_id);
        // $cat_obj->category_name = $this->test_input($req->post('category_name'));
        // $cat_obj->updated_at = date("Y-m-d H:i:s");
        // $cat_obj->save();

        Category::where('id', $category_id)
            ->update([
                'category_name' => $this->test_input($req->post('category_name')),
                'updated_at' => date("Y-m-d H:i:s")
        ]);

        $req->session()->flash('success', 'Category is Updated Successfully!');
        return redirect()->route('category.index');
    }

    public function destroy(Request $req, $category)
    {
        $category = Category::find($category);
        $category_name = $category->category_name;
        $category->delete();
        $req->session()->flash('success', "Category \"$category_name\" has Deleted Successfully...");
        return redirect()->route('category.index');
    }
}
