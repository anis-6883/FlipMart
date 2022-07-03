<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    // Subcategory List
    public function index()
    {
        // $subcategories = DB::table('subcategories as s')
        //                 ->join('categories as c', 'c.id', '=', 's.category_id')
        //                 ->select('c.category_name', 's.*')
        //                 ->orderByDesc('created_at')
        //                 ->get();
        $subcategories = Subcategory::with('category')->latest()->get();
        return view('backend.list-subcategory', compact('subcategories'));
    }

    // Subcategory Create Page
    public function create()
    {
        $categories = Category::orderBy('category_name')->get();
        return view('backend.add-subcategory')->with('categories', $categories);
    }

    // Store Subcategory
    public function store(Request $req)
    {
        $req->validate([
            'subcategory_name' => 'required|max:50',
            'category_id' => 'required'
        ]);

        $isExist = Subcategory::where([
            ['subcategory_name', $req->subcategory_name], 
            ['category_id', $req->category_id]
            ])->exists();

        if($isExist)
            return back()->withErrors(['isExist' => 'The subcategory name has already been taken.']);

        $subcategory = new Subcategory;
        $subcategory->category_id = $req->category_id;
        $subcategory->subcategory_name = $req->subcategory_name;
        $subcategory->subcategory_order = $req->subcategory_order;
        $subcategory->save();
        
        session()->flash('success', 'Subcategory is Created Successfully!');
        return redirect()->route('subcategory.index');
    }

    // Edit Subcategory Page
    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::orderBy('category_name')->get();
        return view('backend.edit-subcategory', compact('categories', 'subcategory'));
    }

    // Update Subcategory
    public function update(Request $req, $id)
    {
        $req->validate([
            'subcategory_name' => 'required',
            'category_id' => 'required'
        ]);
        
        $isExist = Subcategory::where([
            ['subcategory_name', $req->subcategory_name], 
            ['category_id', $req->category_id],
            ['subcategory_order', $req->subcategory_order]
            ])->exists();

        if($isExist)
            return back()->withErrors(['isExist' => 'The subcategory name has already been taken.']);

        $subcategory = Subcategory::findOrFail($id);
        $subcategory->category_id = $req->category_id;
        $subcategory->subcategory_name = $req->subcategory_name;
        $subcategory->subcategory_order = $req->subcategory_order;
        $subcategory->save();

        session()->flash('success', 'Subcategory is Updated Successfully!');
        return redirect()->route('subcategory.index');
    }

    // Delete Subcategory
    public function destroy($subcat_id)
    {
        $subcategory = Subcategory::find($subcat_id);
        $subcategory_name = $subcategory->subcategory_name;
        $subcategory->delete();
        session()->flash('success', "Subcategory \"$subcategory_name\" has Deleted Successfully...");
        return redirect()->route('subcategory.index');
    }
}
