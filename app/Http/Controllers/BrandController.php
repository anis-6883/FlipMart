<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.list-brand', compact('brands'));
    }

    public function create()
    {
        return view('admin.add-brand');
    }

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
            $masterImageName = "BRAND_" . date('YmdHis') . rand(100000, 999999) . "_" . $originalImageName;
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

        return redirect()->route('brand.index')->with('success', 'Brand is Created Successfully!');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.edit-brand', compact('brand'));
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'brand_name' => 'required|max:50',
            'brand_image' => 'mimes:png,jpg,jpeg|max:5048'
        ]);
        
        $obj = Brand::find($id);
        $obj->brand_name = $req->brand_name;
        $prevImageName = $obj->brand_image;

        if($req->hasFile('brand_image') and $req->file('brand_image')->isValid())
        {
            $originalImageName = $req->file('brand_image')->getClientOriginalName();
            $masterImageName = "BRAND_" . date('YmdHis') . rand(100000, 999999) . "_" . $originalImageName;
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

        return redirect()->route('brand.index')->with('success', 'Brand is Updated Successfully!');
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand_name = $brand->brand_name;
        $brand_img_path = public_path('/uploads/brands/' . $brand->brand_image);
        $brand->delete();
        if(File::exists($brand_img_path))
            File::delete($brand_img_path);
            
        return redirect()->back()->with('success', "Brand \"$brand_name\" has Deleted Successfully...");
    }
}
