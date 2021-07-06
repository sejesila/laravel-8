<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function slider(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }
    public function addSlider(){
        return view('admin.slider.create');
    }
    public function store(Request $request){
        $validation_rules =
            [
                'title' => 'required|max:255',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048'
            ];
        $error_messages =
            [
                'image.mimes' => 'Incorrect Image type',
             
            ];

        $validate = Validator::make($request->all(), $validation_rules, $error_messages);

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput();
        } else {
            

         
            // Use image intervention package to resize the images
            $image = $request->file('image');
            $random_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 200)->save('images/home/' . $random_name);
            $last_uploaded = 'images/home/' . $random_name;



            Slider::insert([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_uploaded,
                'created_at' => Carbon::now()
            ]);

            return Redirect::back()->with('success', 'Slider added successfully');
        }

    }
}
