<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    // Slider List
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('backend.list-slider', compact('sliders'));
    }

    // Create Slider Page
    public function create()
    {
        return view('backend.add-slider');
    }

    // Store Slider
    public function store(Request $request)
    {
        $valid_data = $request->validate([
            'slider_name' => ['required', 'min:5'],
            'slider_image_filename' => ['required', 'mimes:png,jpg,jpeg', 'max:5048'],
            'slider_status' => ['required']
        ]);

        $valid_data['slider_order'] = $request->slider_order;

        if($request->hasFile('slider_image_filename') and $request->file('slider_image_filename')->isValid())
        {
            $originalImageName = $request->file('slider_image_filename')->getClientOriginalName();
            $masterImageName = "SLIDER_" . uniqid() . rand(100000, 999999) . "_" . $originalImageName;
            $valid_data['slider_image_filename'] = $masterImageName;
        }

        Slider::create($valid_data);

        if($request->hasFile('slider_image_filename') and $request->file('slider_image_filename')->isValid())
        {
            Image::make($request->file('slider_image_filename'))
                ->resize(870, 370)
                ->save(public_path('/uploads/sliders/' . $masterImageName));
        }

        session()->flash('success', 'Slider is Created Successfully!');
        return redirect()->route('slider.index');
    }

    // Edit Slider Page
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('backend.edit-slider', compact('slider'));
    }

    // Update Slider
    public function update(Request $request, $id)
    {
        $valid_data = $request->validate([
            'slider_name' => ['required', 'min:5'],
            'slider_image_filename' => ['mimes:png,jpg,jpeg', 'max:5048'],
            'slider_status' => ['required']
        ]);

        $valid_data['slider_order'] = $request->slider_order;

        if($request->hasFile('slider_image_filename') and $request->file('slider_image_filename')->isValid())
        {
            $originalImageName = $request->file('slider_image_filename')->getClientOriginalName();
            $masterImageName = "SLIDER_" . uniqid() . rand(100000, 999999) . "_" . $originalImageName;
            $valid_data['slider_image_filename'] = $masterImageName;
        }

        $slider_obj = Slider::findOrFail($id);
        $prevImageName = $slider_obj->slider_image_filename;

        $slider_obj->update($valid_data);

        if($request->hasFile('slider_image_filename') and $request->file('slider_image_filename')->isValid())
        {
            Image::make($request->file('slider_image_filename'))
                ->resize(870, 370)
                ->save(public_path('/uploads/sliders/' . $masterImageName));
                
            $img_path = public_path('/uploads/sliders/' . $prevImageName);
            if(File::exists($img_path))
                File::delete($img_path);
        }

        session()->flash('success', 'Slider is Updated Successfully!');
        return redirect()->route('slider.index');
    }

    // Delete Slider
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider_name = $slider->slider_name;
        $slider->delete();
        session()->flash('success', "Slider \"$slider_name\" has Deleted Successfully...");
        return redirect()->back();
    }
}
