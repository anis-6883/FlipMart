<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    // Brand List
    public function index()
    {
        $brands = Brand::orderBy('brand_name')->get();
        return view('backend.list-brand', compact('brands'));
    }

    // Create Brand Page
    public function create()
    {
        return view('backend.add-brand');
    }

    // Store Bnard
    public function store(Request $req)
    {
        $req->validate([
            'brand_name' => 'required|unique:brands|max:50',
            'brand_image' => 'mimes:png,jpg,jpeg|max:5048'
        ]);
        
        $obj = new Brand;
        $obj->brand_name = $req->brand_name;

        if($req->hasFile('brand_image') and $req->file('brand_image')->isValid())
        {
            $originalImageName = $req->file('brand_image')->getClientOriginalName();
            $masterImageName = "BRAND_" . uniqid() . rand(100000, 999999) . "_" . $originalImageName;
            $obj->brand_image = $masterImageName;
        }

        $obj->save();

        if($req->hasFile('brand_image') and $req->file('brand_image')->isValid())
        {
            Image::make($req->file('brand_image'))
                ->resize(100, 100)
                ->save(public_path('/uploads/brands/' . $masterImageName));
            // $req->brand_image->move(public_path('/uploads/brands'), $masterImageName);
        }

        session()->flash('success', 'Brand is Created Successfully!');
        return redirect()->route('brand.index');
    }

    // Edit Brand Page
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.edit-brand', compact('brand'));
    }

    // Update Brand
    public function update(Request $req, $id)
    {
        $req->validate([
            'brand_name' => 'required|max:50',
            'brand_image' => 'mimes:png,jpg,jpeg|max:5048'
        ]);
        
        $obj = Brand::findOrFail($id);
        $obj->brand_name = $req->brand_name;
        $prevImageName = $obj->brand_image;

        if($req->hasFile('brand_image') and $req->file('brand_image')->isValid())
        {
            $originalImageName = $req->file('brand_image')->getClientOriginalName();
            $masterImageName = "BRAND_" . uniqid() . rand(100000, 999999) . "_" . $originalImageName;
            $obj->brand_image = $masterImageName;
        }

        $obj->save();

        if($req->hasFile('brand_image') and $req->file('brand_image')->isValid())
        {
            Image::make($req->file('brand_image'))
                ->resize(100, 100)
                ->save(public_path('/uploads/brands/' . $masterImageName));

            $img_path = public_path('/uploads/brands/' . $prevImageName);
            if(File::exists($img_path))
                File::delete($img_path);
        }

        session()->flash('success', 'Brand is Updated Successfully!');
        return redirect()->route('brand.index');
    }

    // Delete Brand
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand_name = $brand->brand_name;
        $brand_img_path = public_path('/uploads/brands/' . $brand->brand_image);
        $brand->delete();
        if(File::exists($brand_img_path))
            File::delete($brand_img_path);
            
        session()->flash('success', "Brand \"$brand_name\" has Deleted Successfully...");
        return redirect()->back();
    }
}
