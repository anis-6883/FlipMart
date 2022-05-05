<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_Image;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::with('category', 'subcategory')->latest()->get();
        return view('admin.add-productImages', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $isSaved = $obj->save();
            if($isSaved)
                Image::make($image)->resize(400, 300)->save(public_path('/uploads/product-images/' . $productImageName));
        }

        $request->session()->flash('success', 'Product Images is Uploaded Successfully!');
        // return redirect()->route('product-images.create');
        return redirect()->back()->with('success', 'Product Images is Uploaded Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
