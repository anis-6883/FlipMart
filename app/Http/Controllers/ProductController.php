<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_Detail;
use App\Models\Product_Image;
use App\Models\Sub_Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    // Product List
    public function index()
    {
        // $products = DB::table('products as p')
        //             ->join('categories as c', 'c.id', '=', 'p.category_id')
        //             ->join('subcategories as s', 's.id', '=', 'p.subcategory_id')
        //             ->select('c.category_name', 's.subcategory_name', 'p.*')
        //             ->orderByDesc('created_at')
        //             ->get();

        $products = Product::with('category', 'subcategory', 'sub_subcategory', 'brand')->latest()->get();
        return view('backend.list-product', compact('products'));
    }

    // Create Product Page
    public function create()
    {
        $categories = Category::orderBy('category_name')->get();
        $brands = Brand::orderBy('brand_name')->get();
        return view('backend.add-product', compact('categories', 'brands'));
    }

    // Store Product
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required|min:8',
            'product_regular_price' => 'required|numeric',
            'product_stock' => 'required|integer',
            'product_status' => 'required',
            'product_master_image' => 'mimes:png,jpg,jpeg|max:5048',
        ]);

        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sub_subcategory_id' => $request->sub_subcategory_id,
            'brand_id' => $request->brand_id,
            'product_status' => $request->product_status,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $obj = new Product_Detail;
        $obj->product_name = $request->product_name;
        $obj->product_slug = strtolower(str_replace(str_split('\\/:*?"<>| '), '-', $request->product_name)) . '-' . uniqid() . rand(100000, 999999);
        $obj->product_code = $request->product_code;
        $obj->product_tags = $request->product_tags;
        $obj->product_sizes = $request->product_sizes;
        $obj->product_colors = $request->product_colors;
        $obj->product_order = $request->product_order;
        $obj->product_summary = $request->product_summary;
        $obj->product_description = $request->product_description;
        $obj->product_regular_price = $request->product_regular_price;
        $obj->product_stock = $request->product_stock?: 0;
        $obj->featured = $request->featured ?: 0;
        $obj->hot_deals = $request->hot_deals ?: 0;
        $obj->best_selling = $request->best_selling ?: 0;

        if(!empty($request->discounted_pct))
        {
            $obj->discounted_pct = $request->discounted_pct;
            $obj->discount_start_date = $request->discount_start_date;
            $obj->discount_end_date = $request->discount_end_date;
        }else{
            $obj->discounted_pct = NULL;
            $obj->discount_start_date = NULL;
            $obj->discount_end_date = NULL;
        }

        if($request->hasFile('product_master_image') and $request->file('product_master_image')->isValid())
        {
            $originalImageName = $request->file('product_master_image')->getClientOriginalName();
            $masterImageName = "PRODUCT_" . uniqid() . rand(100000, 999999) . "_" . $originalImageName;
            $obj->product_master_image = $masterImageName;
        }

        Product::findOrFail($product_id)->product_detail()->save($obj);

        if($request->hasFile('product_master_image') and $request->file('product_master_image')->isValid())
        {
            Image::make($request->file('product_master_image'))
                ->resize(400, 300)
                ->save(public_path('/uploads/products/' . $masterImageName));
            // $req->product_master_image->move(public_path('/uploads/products'), $masterImageName);
        }

        session()->flash('success', 'Product is Created Successfully!');
        return redirect()->route('product.index');
    }

    // Show Product Details
    public function show($id)
    {
        $product = Product::with('category', 'subcategory', 'sub_subcategory', 'brand')->where('id', $id)->first();
        return view('backend.show-product', compact('product'));
    }

    // Edit Product
    public function edit($id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::findOrFail($id);
        $sub_subcategories = Sub_Subcategory::where('subcategory_id', $product->subcategory_id)->get();
        return view('backend.edit-product', compact('product', 'categories', 'sub_subcategories', 'brands'));
    }

    // Update Product
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required|min:8',
            'product_regular_price' => 'required|numeric',
            'product_stock' => 'required|integer',
            'product_status' => 'required',
            'product_master_image' => 'mimes:png,jpg,jpeg|max:5048',
        ]);

        Product::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'sub_subcategory_id' => $request->sub_subcategory_id,
            'brand_id' => $request->brand_id,
            'product_status' => $request->product_status,
            // 'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $obj = Product_Detail::with('product')->where('product_id', $id)->first();

        $obj->product_name = $request->product_name;
        $obj->product_slug = strtolower(str_replace(str_split('\\/:*?"<>| '), '-', $request->product_name)) . '-' . uniqid() . rand(100000, 999999);
        $obj->product_code = $request->product_code;
        $obj->product_tags = $request->product_tags;
        $obj->product_sizes = $request->product_sizes;
        $obj->product_colors = $request->product_colors;
        $obj->product_order = $request->product_order;
        $obj->product_summary = $request->product_summary;
        $obj->product_description = $request->product_description;
        $obj->product_regular_price = $request->product_regular_price;
        $obj->product_stock = $request->product_stock ?: 0;
        $obj->featured = $request->featured ?: 0;
        $obj->hot_deals = $request->hot_deals ?: 0;
        $obj->best_selling = $request->best_selling ?: 0;

        if(!empty($request->discounted_pct))
        {
            $obj->discounted_pct = $request->discounted_pct;
            $obj->discount_start_date = $request->discount_start_date;
            $obj->discount_end_date = $request->discount_end_date;
        }else{
            $obj->discounted_pct = NULL;
            $obj->discount_start_date = NULL;
            $obj->discount_end_date = NULL;
        }

        $prevImageName = $obj->product_master_image;

        if($request->hasFile('product_master_image') and $request->file('product_master_image')->isValid())
        {
            $originalImageName = $request->file('product_master_image')->getClientOriginalName();
            $masterImageName = "PRODUCT_" . uniqid() . rand(100000, 999999) . "_" . $originalImageName;
            $obj->product_master_image = $masterImageName;
        }

        $obj->save();

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
        
        session()->flash('success', 'Product is Updated Successfully!');
        return redirect()->route('product.show', $id);
    }

    // Delete Product
    public function destroy(Request $req, $id)
    {
        $product = Product::with('product_image')->where('id', $id)->first();
        $product_name = $product->product_name;

        if(count($product->product_image) > 0)
        {
            foreach($product->product_image as $image)
            {
                $product_image = Product_Image::findOrFail($image->id);
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

        session()->flash('success', "Product \"$product_name\" has Deleted Successfully...");
        return redirect()->route('product.index');
    }
}
