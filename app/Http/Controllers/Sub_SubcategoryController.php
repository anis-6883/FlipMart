<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sub_Subcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class Sub_SubcategoryController extends Controller
{
    // Sub-Subcategory List
    public function index()
    {
        $subcategories = Sub_Subcategory::with('category', 'subcategory')->latest()->get();
        return view('backend.list-subSubcategory', compact('subcategories'));
    }

    // Create Sub-Subcategory Page
    public function create()
    {
        $categories = Category::orderBy('category_name')->get();
        $subcategories = Subcategory::orderBy('subcategory_name')->get();
        return view('backend.add-subSubcategory', compact('categories', 'subcategories'));
    }

    // Store Sub-Subcategory
    public function store(Request $req)
    {
        $req->validate([
            'sub_subcategory_name' => 'required|max:50',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        ]);

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

        session()->flash('success', 'Sub-Subcategory is Created Successfully!');
        return redirect()->route('subSubcategory.index');
    }

    // Edit Sub-Subcategory Page
    public function edit($id)
    {
        $subcategory = Sub_Subcategory::findOrFail($id);
        $categories = Category::all();
        return view('backend.edit-subSubcategory', compact('categories', 'subcategory'));
    }

    // Update Sub-Subcategory
    public function update(Request $req, $id)
    {
        $req->validate([
            'sub_subcategory_name' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        ]);
        
        $isExist = Sub_Subcategory::where([
                ['sub_subcategory_name', $req->sub_subcategory_name], 
                ['category_id', $req->category_id],
                ['subcategory_id', $req->subcategory_id],
                ['sub_subcategory_order', $req->sub_subcategory_order],
            ])->exists();

        if($isExist)
            return back()->withErrors(['isExist' => 'The sub-subcategory name has already been taken.']);

        $obj = Sub_Subcategory::findOrFail($id);
        $obj->sub_subcategory_name = $req->sub_subcategory_name;
        $obj->category_id = $req->category_id;
        $obj->subcategory_id = $req->subcategory_id;
        $obj->sub_subcategory_order = $req->sub_subcategory_order;
        $obj->save();
        
        return redirect()->route('subSubcategory.index')->with('success', 'Sub-Subcategory is Updated Successfully!');
    }

    // Delete Sub-Subcategory
    public function destroy($id)
    {
        $subcategory = Sub_Subcategory::findOrFail($id);
        $sub_subcategory_name = $subcategory->sub_subcategory_name;
        $subcategory->delete();
        session()->flash('success', "Sub-Subcategory \"$sub_subcategory_name\" has Deleted Successfully...");
        return redirect()->route('subSubcategory.index');
    }
}
