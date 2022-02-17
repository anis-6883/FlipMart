<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Product;
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

    public function customerUpdateStatus(Request $req)
    {
        try{
            $customer = Customer::find($req->post('customer_id'));
            $customer->customer_status = $req->post('statusText');
            if($customer->save())
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
            $subcategories = DB::table('subcategories')
            ->where('category_id', $req->post('category_id'))
            ->get();

            if(!empty($subcategories))
                foreach($subcategories as $subcategory)
                {
                    echo '<option value="'. $subcategory->id . '">' . $subcategory->subcategory_name .'</option>';
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
}
