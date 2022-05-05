<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

        $products = Product::with('category', 'subcategory')->latest()->get();
        return view('admin.list-product', compact('products'));
    }

    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('admin.add-product', compact('categories'));
    }

    public function store(Request $req)
    {
        $pro_obj = new Product;

        $req->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_name' => 'required|min:8',
            'product_regular_price' => 'required|numeric',
            'product_quantity' => 'required|integer',
            'product_status' => 'required',
            'product_master_image' => 'mimes:png,jpg,jpeg|max:5048',
        ]);

        $pro_obj->category_id = $req->post('category_id');
        $pro_obj->subcategory_id = $req->post('subcategory_id');
        $pro_obj->product_name = $req->post('product_name');
        $pro_obj->product_order = $req->post('product_order');
        $pro_obj->product_summary = $req->post('product_summary');
        $pro_obj->product_description = $req->post('product_description');
        $pro_obj->product_regular_price = $req->post('product_regular_price');
        $pro_obj->product_quantity = $req->post('product_quantity');
        $pro_obj->product_status = $req->post('product_status');

        if(!empty($req->post('product_discounted_price')))
        {
            $pro_obj->product_discounted_price = $req->post('product_discounted_price');
            $pro_obj->discount_start_date = $req->post('discount_start_date');
            $pro_obj->discount_end_date = $req->post('discount_end_date');
        }

        if($req->hasFile('product_master_image') and $req->file('product_master_image')->isValid())
        {
            $originalImageName = $req->file('product_master_image')->getClientOriginalName();
            $masterImageName = "PRODUCT_" . date('YmdHis') . rand(100000, 999999) . "_" . $originalImageName;
            $pro_obj->product_master_image = $masterImageName;
        }

        $pro_obj->save();

        if($req->hasFile('product_master_image') and $req->file('product_master_image')->isValid())
        {
            Image::make($req->file('product_master_image'))
                ->resize(400, 300)
                ->save(public_path('/uploads/products/' . $masterImageName));
            // $req->product_master_image->move(public_path('/uploads/products'), $masterImageName);
        }
            

        $req->session()->flash('success', 'Product is Created Successfully!');
        return redirect()->route('product.index');
    }

    public function edit($product_id)
    {
        $categories = DB::table('categories')->get();
        $product = Product::find($product_id);
        return view('admin.edit-product', compact('product', 'categories'));
    }

    public function update(Request $req, $product_id)
    {
        $pro_obj = Product::find($product_id);

        $req->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_name' => 'required|min:8',
            'product_regular_price' => 'required|numeric',
            'product_quantity' => 'required|integer',
            'product_status' => 'required',
            'product_master_image' => 'mimes:png,jpg,jpeg|max:5048',
        ]);

        $pro_obj->category_id = $req->post('category_id');
        $pro_obj->subcategory_id = $req->post('subcategory_id');
        $pro_obj->product_name = $req->post('product_name');
        $pro_obj->product_order = $req->post('product_order');
        $pro_obj->product_summary = $req->post('product_summary');
        $pro_obj->product_description = $req->post('product_description');
        $pro_obj->product_regular_price = $req->post('product_regular_price');
        $pro_obj->product_quantity = $req->post('product_quantity');
        $pro_obj->product_status = $req->post('product_status');

        if(!empty($req->post('product_discounted_price')))
        {
            $pro_obj->product_discounted_price = $req->post('product_discounted_price');
            $pro_obj->discount_start_date = $req->post('discount_start_date');
            $pro_obj->discount_end_date = $req->post('discount_end_date');
        }

        $prevImageName = $pro_obj->product_master_image;

        if($req->hasFile('product_master_image') and $req->file('product_master_image')->isValid())
        {
            $originalImageName = $req->file('product_master_image')->getClientOriginalName();
            $masterImageName = "PRODUCT_" . date('YmdHis') . rand(100000, 999999) . "_" . $originalImageName;
            $pro_obj->product_master_image = $masterImageName;
        }

        $pro_obj->save();

        if($req->hasFile('product_master_image') and $req->file('product_master_image')->isValid())
        {
            // $req->product_master_image->move(public_path('/uploads/products'), $masterImageName);
            Image::make($req->file('product_master_image'))
                ->resize(400, 300)
                ->save(public_path('/uploads/products/' . $masterImageName));
            $img_path = public_path('/uploads/products/' . $prevImageName);
            if(File::exists($img_path))
                File::delete($img_path);
        }

        $req->session()->flash('success', 'Product is Updated Successfully!');
        return redirect()->route('product.index');
    }

    public function destroy(Request $req, $product_id)
    {
        $product = Product::find($product_id);
        $product_name = $product->product_name;
        $img_path = public_path('/uploads/products/' . $product->product_master_image);
        $product->delete();

        if(File::exists($img_path))
            File::delete($img_path);
            
        $req->session()->flash('success', "Product \"$product_name\" has Deleted Successfully...");
        return redirect()->route('product.index');
    }
}
