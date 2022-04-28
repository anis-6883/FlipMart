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
        $categories = DB::table('categories')->get();
        return view('admin.add-subcategory')->with('categories', $categories);
    }

    public function store(Request $req)
    {
        $valid_data = $req->validate([
            'subcategory_name' => 'required|unique:subcategories',
            'category_id' => 'required'
        ]);

        Subcategory::create($valid_data);

        $req->session()->flash('success', 'Subcategory is Created Successfully!');
        return redirect()->route('subcategory.index');
    }

    public function edit($subcat_id)
    {
        $arr['subcategory'] = Subcategory::find($subcat_id);
        $arr['categories'] = Category::all();
        return view('admin.edit-subcategory', $arr);
    }

    public function update(Request $req, $subcat_id)
    {
        $subcat_obj = Subcategory::find($subcat_id);

        $req->validate([
            'subcategory_name' => 'required|unique:subcategories',
            'category_id' => 'required'
        ]);

        $subcat_obj->category_id = $req->post('category_id');
        $subcat_obj->subcategory_name = $req->post('subcategory_name');
        $subcat_obj->save();

        $req->session()->flash('success', 'Subcategory is Updated Successfully!');
        return redirect()->route('subcategory.index');
    }

    public function destroy(Request $req, $subcat_id)
    {
        $subcategory = Subcategory::find($subcat_id);
        $subcategory_name = $subcategory->subcategory_name;
        $subcategory->delete();
        $req->session()->flash('success', "Subcategory \"$subcategory_name\" has Deleted Successfully...");
        return redirect()->route('subcategory.index');
    }
}
