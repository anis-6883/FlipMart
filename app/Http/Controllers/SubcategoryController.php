<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    public function index()
    {
        // $subcategories = DB::table('subcategories as s')
        //                 ->join('categories as c', 'c.id', '=', 's.category_id')
        //                 ->select('c.category_name', 's.*')
        //                 ->orderByDesc('created_at')
        //                 ->get();
        $subcategories = Subcategory::latest('created_at')->with('category')->get();
        return view('admin.list-subcategory', compact('subcategories'));
    }

    public function create()
    {
        // $categories = DB::table('categories')->get();
        $categories = Category::orderBy('category_name')->get();
        return view('admin.add-subcategory')->with('categories', $categories);
    }

    public function store(Request $req)
    {
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
        
        return redirect()->route('subcategory.index')->with('success', 'Subcategory is Created Successfully!');
    }

    public function edit($subcat_id)
    {
        $subcategory = Subcategory::find($subcat_id);
        $categories = Category::all();
        return view('admin.edit-subcategory', compact('categories', 'subcategory'));
    }

    public function update(Request $req, $subcat_id)
    {
        $isExist = Subcategory::where([
            ['subcategory_name', $req->subcategory_name], 
            ['category_id', $req->category_id],
            ['subcategory_order', $req->subcategory_order]
            ])->exists();

        if($isExist)
            return back()->withErrors(['isExist' => 'The subcategory name has already been taken.']);

        $subcategory = Subcategory::find($subcat_id);
        $subcategory->category_id = $req->category_id;
        $subcategory->subcategory_name = $req->subcategory_name;
        $subcategory->subcategory_order = $req->subcategory_order;
        $subcategory->save();
        return redirect()->route('subcategory.index')->with('success', 'Subcategory is Updated Successfully!');
    }

    public function destroy($subcat_id)
    {
        $subcategory = Subcategory::find($subcat_id);
        $subcategory_name = $subcategory->subcategory_name;
        $subcategory->delete();
        return redirect()->route('subcategory.index')->with('success', "Subcategory \"$subcategory_name\" has Deleted Successfully...");
    }
}
