<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

/**
* @group Category Management
*
* APIs to manage the category resource
**/

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $req)
    {
        $req->validate([
            'category_name' => 'required|unique:categories|max:50'
        ]);

        // $cat_obj = new Category;
        // $cat_obj->category_name = $req->post('category_name');
        // $cat_obj->category_order = $req->post('category_order') ?: 0;
        // $cat_obj->save();

        Category::create($req->all());
        return response()->json(['success' => 'Category is Created Successfully!']);
    }

    public function show($id)
    {
        $exits = Category::where('id', $id)->first();
        if($exits)
            return $exits;
        else
            return response()->json(['error' => 'This Category is Not Found!']);
    }

 
    public function update(Request $req, $id)
    {
        $isExist = Category::where([
            ['category_name', $req->category_name], 
            ['category_order', $req->category_order]
            ])->exists();
            
        if($isExist)
            return response()->json(['isExist' => 'The category name has already been taken.']);
            
        Category::find($id)->update($req->all());
            
        return response()->json(['success' => 'Category is Updated Successfully!']);
    }

    public function destroy($id)
    {
        if(Category::destroy($id))
            return response()->json(['success' => 'Category is Deleted Successfully!']);
        else
            return response()->json(['error' => 'This Category is Not Found!']);

    }

    public function search($name)
    {
        return Category::where('category_name', 'LIKE', '%'. $name .'%')->get();
    }
}
