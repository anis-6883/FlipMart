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

    public function store(Request $request)
    {
        $valid_data = $request->validate([
            'sub_subcategory_name' => 'required|unique:sub_subcategories',
            'category_id' => 'required',
            'subcategory_id' => 'required'
        ]);

        Sub_Subcategory::create($valid_data);
        return redirect()->route('subSubcategory.index')->with('success', 'Sub-Subcategory is Created Successfully!');
    }

    public function edit($id)
    {
        $sub_subCat = Sub_Subcategory::find($id);
        $categories = Category::orderBy('category_name')->get();
        return view('admin.edit-subSubcategory', compact('categories', 'sub_subCat'));
    }

    public function update(Request $request, $id)
    {
        $valid_data = $request->validate([
            'sub_subcategory_name' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required'
        ]);

        $subcat_obj = Sub_Subcategory::where([
            ['sub_subcategory_name', '=', $request->sub_subcategory_name],
            ['category_id', '=', $request->category_id],
            ['subcategory_id', '=', $request->subcategory_id],
            ])->first();

        if($subcat_obj)
            return redirect()->back()->with('danger', 'The sub-subcategory has already been taken...');

        Sub_Subcategory::find($id)->update($valid_data);
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
