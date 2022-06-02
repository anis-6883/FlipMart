<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sub_Subcategory as Sub_Subcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class Sub_SubcategoryController extends Controller
{
    public function index()
    {
        $sub_subCats = Sub_Subcategory::with('category', 'subcategory')->latest('created_at')->get();
        return view('admin.list-subSubcategory', compact('sub_subCats'));
    }

    public function create()
    {
        $categories = Category::orderBy('category_name')->get();
        $subcategories = Subcategory::orderBy('subcategory_name')->get();
        return view('admin.add-subSubcategory', compact('categories', 'subcategories'));
    }

    public function store(Request $req)
    {
        $isExist = Sub_Subcategory::where([
            ['sub_subcategory_name', $req->sub_subcategory_name], 
            ['category_id', $req->category_id],
            ['subcategory_id', $req->subcategory_id]
            ])->exists();

        if($isExist)
            return back()->withErrors(['isExist' => 'The sub-subcategory name has already been taken.']);

        $obj = new Sub_Subcategory;
        $obj->sub_subcategory_name = $req->sub_subcategory_name;
        $obj->category_id = $req->category_id;
        $obj->subcategory_id = $req->subcategory_id;
        $obj->sub_subcategory_order = $req->sub_subcategory_order;
        $obj->save();

        return redirect()->route('subSubcategory.index')->with('success', 'Sub-Subcategory is Created Successfully!');
    }

    public function edit($id)
    {
        $sub_subCat = Sub_Subcategory::find($id);
        $categories = Category::all();
        return view('admin.edit-subSubcategory', compact('categories', 'sub_subCat'));
    }

    public function update(Request $req, $id)
    {
        $isExist = Sub_Subcategory::where([
                ['sub_subcategory_name', $req->sub_subcategory_name], 
                ['category_id', $req->category_id],
                ['subcategory_id', $req->subcategory_id],
                ['sub_subcategory_order', $req->sub_subcategory_order],
            ])->exists();


        if($isExist)
            return back()->withErrors(['isExist' => 'The sub-subcategory name has already been taken.']);

        $obj = Sub_Subcategory::find($id);
        $obj->sub_subcategory_name = $req->sub_subcategory_name;
        $obj->category_id = $req->category_id;
        $obj->subcategory_id = $req->subcategory_id;
        $obj->sub_subcategory_order = $req->sub_subcategory_order;
        $obj->save();
        
        return redirect()->route('subSubcategory.index')->with('success', 'Sub-Subcategory is Updated Successfully!');
    }

    public function destroy($id)
    {
        $sub_subCat = Sub_Subcategory::find($id);
        $sub_subcategory_name = $sub_subCat->sub_subcategory_name;
        $sub_subCat->delete();
        return redirect()->route('subSubcategory.index')->with('success', "Sub-Subcategory \"$sub_subcategory_name\" has Deleted Successfully...");
    }
}
