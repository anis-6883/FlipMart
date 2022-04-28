<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Subcategory;

class CustomerController extends Controller
{

    public function practice()
    {
        // $customers = Customer::all();
        // $customers = Customer::first();
        // $customers = Customer::count();
        // $customers = Customer::pluck('customer_name');
        // $customers = Customer::find(2);
        // $customers = Customer::findOrFail(12122);
        // $categories = Category::find(1);
        // return $categories->subcategories->where("subcategory_status", "Active")->count();

        $subcategories = Subcategory::latest('created_at')->with('category')->get(); // Eager Loading
        
        return view('practice', compact('subcategories'));
    }

    public function index()
    {
        $customers = Customer::all();
        return view('admin.list-customer', compact('customers'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
