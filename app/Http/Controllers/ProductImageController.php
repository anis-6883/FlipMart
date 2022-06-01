<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductImageController extends Controller
{
    public function index()
    {
        $products = Product::with('product_image')->get();
        return view('admin.list-productImages', compact('products'));
    }

    public function create()
    {
        $products = Product::with('category', 'subcategory')->latest()->get();
        return view('admin.add-productImages', compact('products'));
    }

    public function store(Request $request)
    {
        $multi_images = $request->file('product_images');
        $product_id = $request->post('product_id');

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
            $productImageName = "PRODUCT_IMAGES_" . date('YmdHis') . rand(100000, 999999) . "_" . $originalImageName;
            $obj->product_image_filename = $productImageName;
            $obj->product_id = $product_id;
            if($obj->save())
                Image::make($image)->resize(400, 300)->save(public_path('/uploads/product-images/' . $productImageName));
        }
        return redirect()->route('product-images.index')->with('success', 'Product Images is Uploaded Successfully!');
    }

    public function edit($id)
    {
        $product = Product::with('product_image')->where('id', $id)->first();
        if(count($product->product_image) > 0)
        {
            return view('admin.delete-productImages', compact('product'));
        }
        return redirect()->back()->withErrors(['error' => 'This product has no images for deleteing... Please Add Images!']);
    }

    public function destroy(Request $req, $id)
    {
        $product_image = Product_Image::find($id);
        $img_path = public_path('/uploads/product-images/' . $product_image->product_image_filename);
        $product_image->delete();
        if(File::exists($img_path))
            File::delete($img_path);
            
        $product = Product::with('product_image')->where('id', $req->product_id)->first();
        if(count($product->product_image) > 0)
            return redirect()->back()->with('success', 'Product Image is Deleted Successfully');
        else
        return redirect()->route('product-images.index')->with('success', 'Delete All Images Of Product "'. $product->product_name .'"!');
    }

    public function destoryAll($id)
    {
        $product = Product::with('product_image')->where('id', $id)->first();
        if(count($product->product_image) > 0)
        {
            foreach($product->product_image as $image)
            {
                $product_image = Product_Image::find($image->id);
                $img_path = public_path('/uploads/product-images/' . $image->product_image_filename);
                $product_image->delete();
                if(File::exists($img_path))
                    File::delete($img_path);
            }
            return redirect()->route('product-images.index')->with('success', 'Delete All Images Of Product "'. $product->product_name .'"!');
        }
        return redirect()->back()->withErrors(['error' => 'This product has no images for deleteing... Please Add Images!']);
    }
}
