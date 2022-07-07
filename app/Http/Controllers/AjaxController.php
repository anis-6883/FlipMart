<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Product_Image;
use App\Models\Slider;
use App\Models\Sub_Subcategory;
use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    
    public function categoryUpdateStatus(Request $req)
    {
        try{
            $category = Category::find($req->post('category_id'));
            $category->category_status = $req->post('statusText');
            if($category->save())
                return 1;
            else
                return 0;
        }
        catch(Exception $e){
            return 0;
        }
    }

    public function subcategoryUpdateStatus(Request $req)
    {
        try{
            $subcategory = Subcategory::find($req->post('subcategory_id'));
            $subcategory->subcategory_status = $req->post('statusText');
            if($subcategory->save())
                return 1;
            else
                return 0;
        }
        catch(Exception $e){
            return 0;
        }
    }

    public function subSubcategoryUpdateStatus(Request $req)
    {
        try{
            $subcategory = Sub_Subcategory::find($req->post('subcategory_id'));
            $subcategory->sub_subcategory_status = $req->post('statusText');
            if($subcategory->save())
                return 1;
            else
                return 0;
        }
        catch(Exception $e){
            return 0;
        }
    }

    public function brandUpdateStatus(Request $req)
    {
        try{
            $brand = Brand::find($req->post('brand_id'));
            $brand->brand_status = $req->post('statusText');
            if($brand->save())
                return 1;
            else
                return 0;
        }
        catch(Exception $e){
            return 0;
        }
    }

    public function productUpdateStatus(Request $req)
    {
        try{
            $product = Product::find($req->post('product_id'));
            $product->product_status = $req->post('statusText');
            if($product->save())
                return 1;
            else
                return 0;
        }
        catch(Exception $e){
            return 0;
        }
    }

    public function couponUpdateStatus(Request $req)
    {
        try{
            $coupon = Coupon::find($req->post('coupon_id'));
            $coupon->coupon_status = $req->post('statusText');
            if($coupon->save())
                return 1;
            else
                return 0;
        }
        catch(Exception $e){
            return 0;
        }
    }

    public function productImageUpdateStatus(Request $req)
    {
        try{
            $image = Product_Image::find($req->post('image_id'));
            $image->image_status = $req->post('statusText');
            if($image->save())
                return 1;
            else
                return 0;
        }
        catch(Exception $e){
            return 0;
        }
    }

    public function sliderUpdateStatus(Request $req)
    {
        try{
            $slider = Slider::find($req->post('slider_id'));
            $slider->slider_status = $req->post('statusText');
            if($slider->save())
                return 1;
            else
                return 0;
        }
        catch(Exception $e){
            return 0;
        }
    }

    public function loadSubcategory(Request $req)
    {
        try
        {
            $subcategories = Subcategory::where('category_id', $req->post('category_id'))->get();

            if(count($subcategories) > 0)
            {
                echo "<option value=''>Select Subcategory</option>";

                foreach($subcategories as $subcategory)
                {
                    echo '<option value="'. $subcategory->id . '">' . $subcategory->subcategory_name .'</option>';
                }
            }
            else
                return ['option' => "<option value=''>No Subcategory Found</option>"];
                // echo ;
        }
        catch(Exception $e)
        {
            return 0;
        } 
    }

    public function loadSubSubcategory(Request $req)
    {
        try
        {
            $subcategories = Sub_Subcategory::where('subcategory_id', $req->subcategory_id)->get();

            if(!empty($subcategories))
                foreach($subcategories as $subcategory)
                {
                    echo '<option value="'. $subcategory->id . '">' . $subcategory->sub_subcategory_name .'</option>';
                }
            else
                return 0;
        }
        catch(Exception $e)
        {
            return 0;
        } 
    }

    public function loadSeletedSubcategory(Request $req)
    {
        try
        {
            $subcategories = DB::table('subcategories')
                            ->where('category_id', $req->post('category_id'))
                            ->get();

            if(!empty($subcategories))
                foreach($subcategories as $subcategory)
                {
                    echo '<option value="'. $subcategory->id . '"';
                    
                        if($subcategory->id == $req->post('subcategory_id')) echo "selected";
                    
                    echo '>' . $subcategory->subcategory_name .'</option>';
                }
            else
                return 0;
        }
        catch(Exception $e)
        {
            return 0;
        } 
    }

    //fetch product data
    public function fetchProductData(Request $request)
    {
        $product = Product::with('product_detail', 'category', 'subcategory')->findOrFail($request->post('product_id'));
        $product_colors = explode(',', $product->product_detail->product_colors);
        $product_sizes = explode(',', $product->product_detail->product_sizes);

        if($product->product_detail->product_discounted_price != NULL)
        {
            $discount_price = ($product->product_detail->product_regular_price * $product->product_detail->product_discounted_price) / 100;
            $product_price = $product->product_detail->product_regular_price - $discount_price;
        }
        else{
            $product_price = $product->product_detail->product_regular_price;
        }

        return response()->json(array(
            'product' => $product,
            'product_colors' => $product_colors,
            'product_sizes' => $product_sizes,
            'product_price' => $product_price
        ));
    }


}
