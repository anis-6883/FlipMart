<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductImageController extends Controller
{
    // Product Images List
    public function index()
    {
        $products = Product::with('product_detail', 'product_images')->get();
        return view('backend.list-productImages', compact('products'));
    }

    // Create Product Images Page
    public function create()
    {
        $products = Product::with('category', 'subcategory', 'product_detail')->latest()->get();
        return view('backend.add-productImages', compact('products'));
    }

    // Store Product Images
    public function store(Request $request)
    {
        $multi_images = $request->file('product_images');
        $product_id = $request->product_id;

        $request->validate([
            'product_images' => 'required',
            'product_images.*' => 'mimes:jpeg,jpg,png|max:5120'
          ],
        [
            'product_images.*.mimes' => "The accepted file type: jpg, jpeg, png"
        ]);
        
        foreach($multi_images as $image)
        {
            $obj = new Product_Image;
            $originalImageName = $image->getClientOriginalName();
            $productImageName = "PRODUCT_IMAGES_" . uniqid() . rand(100000, 999999) . "_" . $originalImageName;
            $obj->product_image_filename = $productImageName;
            $obj->product_id = $product_id;
            if($obj->save())
                Image::make($image)->resize(400, 300)->save(public_path('/uploads/product-images/' . $productImageName));
        }

        session()->flash('success', 'Product Images is Uploaded Successfully!');
        return redirect()->route('product-images.index');
    }

    // Edit Product Images Page
    public function edit($id)
    {
        $product = Product::with('product_images')->where('id', $id)->first();
        if(count($product->product_images) > 0)
        {
            return view('backend.delete-productImages', compact('product'));
        }
        session()->flash('warning', 'This product has no images for deleteing... Please Add Images!');
        return redirect()->back();
    }

    // Delete Product Image
    public function destroy(Request $req, $id)
    {
        $product_image = Product_Image::find($id);
        $img_path = public_path('/uploads/product-images/' . $product_image->product_image_filename);
        $product_image->delete();
        if(File::exists($img_path))
            File::delete($img_path);
            
        $product = Product::with('product_images')->where('id', $req->product_id)->first();
        if(count($product->product_images) > 0)
            return redirect()->back()->with('success', 'Product Image is Deleted Successfully');
        else{
            session()->flash('success', 'Delete All Images Of Product "'. $product->product_name .'"!');
            return redirect()->route('product-images.index');
        }
    }

    // Delete Product Images
    public function destoryAll($id)
    {
        $product = Product::with('product_images', 'product_detail')->where('id', $id)->first();
        if(count($product->product_images) > 0)
        {
            foreach($product->product_images as $image)
            {
                $product_image = Product_Image::find($image->id);
                $img_path = public_path('/uploads/product-images/' . $image->product_image_filename);
                $product_image->delete();
                if(File::exists($img_path))
                    File::delete($img_path);
            }
            session()->flash('success', 'Delete All Images Of Product "'. $product->product_detail->product_name .'"!');
            return redirect()->route('product-images.index');
        }
        session()->flash('warning', 'This product has no images for deleteing... Please Add Images!');
        return redirect()->back();
    }
}
