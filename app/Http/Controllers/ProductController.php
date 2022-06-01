<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Product_Image;
use App\Models\Sub_Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        // $products = DB::table('products as p')
        //             ->join('categories as c', 'c.id', '=', 'p.category_id')
        //             ->join('subcategories as s', 's.id', '=', 'p.subcategory_id')
        //             ->select('c.category_name', 's.subcategory_name', 'p.*')
        //             ->orderByDesc('created_at')
        //             ->get();

        $products = Product::with('category', 'subcategory', 'sub_subcategory', 'brand')->latest()->get();
        return view('admin.list-product', compact('products'));
    }

    public function create()
    {
        $categories = DB::table('categories')->orderBy('category_name')->get();
        $brands = Brand::all();
        return view('admin.add-product', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $valid_data = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'sub_subcategory_id' => 'required',
            'brand_id' => 'required',
            'product_name' => 'required|min:8',
            'product_regular_price' => 'required|numeric',
            'product_quantity' => 'required|integer',
            'product_status' => 'required',
            'product_master_image' => 'mimes:png,jpg,jpeg|max:5048',
        ]);

        // Not required (Default: NULL) 
        $valid_data['product_slug'] = strtolower(str_replace(str_split('\\/:*?"<>| '), '-', $request->product_name)) . '-' . date('YmdHis') . rand(100000, 999999);
        $valid_data['product_code'] = $request->product_code;
        $valid_data['product_summary'] = $request->product_summary;     
        $valid_data['product_description'] = $request->product_description;
        $valid_data['product_offer'] = $request->product_offer;
        $valid_data['product_order'] = $request->product_order;
        $valid_data['product_tags'] = $request->product_tags;
        $valid_data['product_color'] = $request->product_color;
        $valid_data['product_size'] = $request->product_size;
        $valid_data['featured'] = $request->featured ?: 0;
        $valid_data['hot_deals'] = $request->hot_deals ?: 0;
        $valid_data['special_offer'] = $request->special_offer ?: 0;

        if(!empty($request->product_discounted_price))
        {
            $valid_data['product_discounted_price'] = $request->product_discounted_price;
            $valid_data['discount_start_date'] = $request->discount_start_date;
            $valid_data['discount_end_date'] = $request->discount_end_date;
        }else{
            $valid_data['product_discounted_price'] = NULL;
            $valid_data['discount_start_date'] = NULL;
            $valid_data['discount_end_date'] = NULL;
        }

        if($request->hasFile('product_master_image') and $request->file('product_master_image')->isValid())
        {
            $originalImageName = $request->file('product_master_image')->getClientOriginalName();
            $masterImageName = "PRODUCT_" . date('YmdHis') . rand(100000, 999999) . "_" . $originalImageName;
            $valid_data['product_master_image'] = $masterImageName;
        }

        Product::create($valid_data);

        if($request->hasFile('product_master_image') and $request->file('product_master_image')->isValid())
        {
            Image::make($request->file('product_master_image'))
                ->resize(400, 300)
                ->save(public_path('/uploads/products/' . $masterImageName));
            // $req->product_master_image->move(public_path('/uploads/products'), $masterImageName);
        }

        return redirect()->route('product.index')->with('success', 'Product is Created Successfully!');
    }

    public function show($product_id)
    {
        $product = Product::with('category', 'subcategory', 'sub_subcategory', 'brand')->where('id', $product_id)->first();
        return view('admin.show-product', compact('product'));
    }

    public function edit($product_id)
    {
        $categories = DB::table('categories')->get();
        $brands = Brand::all();
        $product = Product::find($product_id);
        $sub_subcategories = Sub_Subcategory::where('subcategory_id', $product->subcategory_id)->get();
        return view('admin.edit-product', compact('product', 'categories', 'sub_subcategories', 'brands'));
    }

    public function update(Request $request, $product_id)
    {
        $valid_data = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'sub_subcategory_id' => 'required',
            'brand_id' => 'required',
            'product_name' => 'required|min:8',
            'product_regular_price' => 'required|numeric',
            'product_quantity' => 'required|integer',
            'product_status' => 'required',
            'product_master_image' => 'mimes:png,jpg,jpeg|max:5048',
        ]);

        // Not required (Default: NULL) 
        $valid_data['product_slug'] = strtolower(str_replace(str_split('\\/:*?"<>| '), '-', $request->product_name)) . '-' . date('YmdHis') . rand(100000, 999999);
        $valid_data['product_code'] = $request->product_code;
        $valid_data['product_summary'] = $request->product_summary;     
        $valid_data['product_description'] = $request->product_description;
        $valid_data['product_offer'] = $request->product_offer;
        $valid_data['product_order'] = $request->product_order;
        $valid_data['product_tags'] = $request->product_tags;
        $valid_data['product_color'] = $request->product_color;
        $valid_data['product_size'] = $request->product_size;
        $valid_data['featured'] = $request->featured ?: 0;
        $valid_data['hot_deals'] = $request->hot_deals ?: 0;
        $valid_data['special_offer'] = $request->special_offer ?: 0;

        if(!empty($request->product_discounted_price))
        {
            $valid_data['product_discounted_price'] = $request->product_discounted_price;
            $valid_data['discount_start_date'] = $request->discount_start_date;
            $valid_data['discount_end_date'] = $request->discount_end_date;
        }else{
            $valid_data['product_discounted_price'] = NULL;
            $valid_data['discount_start_date'] = NULL;
            $valid_data['discount_end_date'] = NULL;
        }

        $pro_obj = Product::find($product_id);
        $prevImageName = $pro_obj->product_master_image;

        if($request->hasFile('product_master_image') and $request->file('product_master_image')->isValid())
        {
            $originalImageName = $request->file('product_master_image')->getClientOriginalName();
            $masterImageName = "PRODUCT_" . date('YmdHis') . rand(100000, 999999) . "_" . $originalImageName;
            $valid_data['product_master_image'] = $masterImageName;
        }

        $pro_obj->update($valid_data);

        if($request->hasFile('product_master_image') and $request->file('product_master_image')->isValid())
        {
            // $req->product_master_image->move(public_path('/uploads/products'), $masterImageName);
            Image::make($request->file('product_master_image'))
                ->resize(400, 300)
                ->save(public_path('/uploads/products/' . $masterImageName));
            $img_path = public_path('/uploads/products/' . $prevImageName);
            if(File::exists($img_path))
                File::delete($img_path);
        }
        
        return redirect()->route('product.show', $product_id)->with('success', 'Product is Updated Successfully!');
    }

    public function destroy(Request $req, $product_id)
    {
        $product = Product::with('product_image')->where('id', $product_id)->first();
        $product_name = $product->product_name;

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
        }

        $master_img_path = public_path('/uploads/products/' . $product->product_master_image);
        $product->delete();

        if(File::exists($master_img_path))
            File::delete($master_img_path);

        $req->session()->flash('success', "Product \"$product_name\" has Deleted Successfully...");
        return redirect()->route('product.index');
    }
}
