<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    
    public function categoryUpdateStatus(Request $req)
    {
        $category = Category::find($req->post('category_id'));
        $category->category_status = $req->post('statusText');
        if($category->save())
            return 1;
        else
            return 0;
    }
}
