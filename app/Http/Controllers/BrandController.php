<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }
    public function addBrand(Request $request)
    {
        $validation_rules =
            [
                'brand_name' => 'required|max:255',
                'brand_image' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048'

            ];
            [
                'brand_image.mimes' => 'Incorrect Image type'

            ];
        
        $validate = Validator::make($request->all(), $validation_rules);

        if ($validate->fails()) {
            return Redirect::back()->withInput();
        }
        else {
            /*   generate random image name and upload */

            $image = $request->file('brand_image');
            $random_name = hexdec(uniqid());
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = $random_name . '.' . $image_extension;
            $upload_location = 'images/brand/';
            $last_uploaded = $upload_location . $image_name;
            $image->move($upload_location, $image_name);

            Brand::insert([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_uploaded,
                'created_at' => Carbon::now()
            ]);

            return Redirect::back()->with('success', 'Brand added successfully');
        }
    }
}
