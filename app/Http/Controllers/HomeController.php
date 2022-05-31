<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('product_status', 'Active')->orderBy('product_name')->get();
        $sliders = Slider::where('slider_status', 'Active')->orderBy('slider_order', 'ASC')->limit(3)->get();
        $categories = Category::where('category_status', 'Active')->get();

        $featured = Product::where([
            ['product_status', 'Active'],
            ['featured', '1']
        ])->limit(6)->get();

        return view('index', compact('sliders', 'categories', 'products', 'featured'));
    }

    public function productDetails($id, $slug)
    {
        $product = Product::where('product_slug', $slug)->with('product_image')->first();
        $related_product = Product::where([
            ['category_id', $product->category_id],
            ['id', '!=', $id]
            ])->get();
        return view('product-details', compact('product', 'related_product'));
    }

    public function tagWiseProducts($tag)
    {
        $tagwiseProducts = Product::where([
            ['product_tags', 'LIKE', '%'. $tag .'%'],
            ['product_status', 'Active'],
            ])->paginate(3);
        return view('tagWise-products', compact('tagwiseProducts'));
    }

    public function subCategoryWiseProducts($subCat_id, $subCat_name)
    {
        $subCategoryWiseProducts = Product::where([
            ['subcategory_id', $subCat_id],
            ['product_status', 'Active'],
            ])->paginate(3);
        return view('subCategoryWise-products', compact('subCategoryWiseProducts'));
    }

    public function sub_subCategoryWiseProducts($sub_subCat_id, $sub_subCat_name)
    {
        $sub_subCategoryWiseProducts = Product::where([
            ['sub_subcategory_id', $sub_subCat_id],
            ['product_status', 'Active'],
            ])->paginate(3);
        return view('subSubCategoryWise-products', compact('sub_subCategoryWiseProducts'));
    }
}
