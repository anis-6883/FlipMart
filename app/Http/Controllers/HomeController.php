<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $products = DB::table('products as p')
        ->join('product_details as pd', 'pd.product_id', '=', 'p.id')
        ->select('p.*', 'pd.*')
        ->orderByDesc('p.created_at')
        ->where('p.product_status', 'Active')
        ->limit(10)
        ->get();

        $sliders = Slider::where('slider_status', 'Active')->orderBy('slider_order', 'ASC')->get();
        $categories = Category::where('category_status', 'Active')->get();

        return view('frontend.index', compact('sliders', 'categories', 'products'));
    }

    public function productDetails($id)
    {
        $product = Product::with('product_detail', 'product_images')->findOrFail($id);
        $related_product = Product::where([ ['category_id', $product->category_id], ['id', '!=', $id] ])->get();
        $wishlist = Wishlist::where([['user_id', Auth::id()], ['product_id', $product->id]])->first();
        return view('frontend.product-details', compact('product', 'related_product', 'wishlist'));
    }

    // public function tagWiseProducts($tag)
    // {
    //     $tagwiseProducts = Product::where([
    //         ['product_tags', 'LIKE', '%'. $tag .'%'],
    //         ['product_status', 'Active'],
    //         ])->paginate(3);
    //     return view('frontend.tagWise-products', compact('tagwiseProducts'));
    // }

    public function subCategoryWiseProducts($subCat_id, $subCat_name)
    {
        $subCategoryWiseProducts = Product::with('product_detail')->where([
            ['subcategory_id', $subCat_id],
            ['product_status', 'Active'],
            ])->paginate(3);
        return view('frontend.subCategoryWise-products', compact('subCategoryWiseProducts'));
    }

    public function sub_subCategoryWiseProducts($sub_subCat_id, $sub_subCat_name)
    {
        $sub_subCategoryWiseProducts = Product::with('product_detail')->where([
            ['sub_subcategory_id', $sub_subCat_id],
            ['product_status', 'Active'],
            ])->paginate(3);
        return view('frontend.subSubCategoryWise-products', compact('sub_subCategoryWiseProducts'));
    }
}
