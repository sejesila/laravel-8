<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        $error_messages =
            [
                'brand_image.mimes' => 'Incorrect Image type',
                'brand_image.name' => 'Please enter image name'
            ];

        $validate = Validator::make($request->all(), $validation_rules, $error_messages);

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput();
        } else {
            /*  /*   generate random image name and upload
            $image = $request->file('brand_image');
            $random_name = hexdec(uniqid());
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = $random_name . '.' . $image_extension;
            $upload_location = 'images/brand/';
            $last_uploaded = $upload_location . $image_name;
            $image->move($upload_location, $image_name);

         */
            // Use image intervention package to resize the images
            $image = $request->file('brand_image');
            $random_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 200)->save('images/brand/' . $random_name);
            $last_uploaded = 'images/brand/' . $random_name;



            Brand::insert([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_uploaded,
                'created_at' => Carbon::now()
            ]);

            return Redirect::back()->with('success', 'Brand added successfully');
        }
    }
    public function editBrand($id)
    {
        $brands = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brands'));
    }
    public function updateBrand(Request $request, $id)
    {
        $validation_rules =
            [
                'brand_name' => 'required|max:255',

            ];

        $validate = Validator::make($request->all(), $validation_rules);

        if ($validate->fails()) {
            return Redirect::back()->withInput();
        } else {

            $old_image = $request->old_image;

            $image = $request->file('brand_image');

            if ($image) {

                /*    Execute this if image field is edited */

                $random_name = hexdec(uniqid());
                $image_extension = strtolower($image->getClientOriginalExtension());
                $image_name = $random_name . '.' . $image_extension;
                $upload_location = 'images/brand/';
                $last_uploaded = $upload_location . $image_name;

                $image->move($upload_location, $image_name);


                //dd($old_image);
                unlink($old_image);
                //File::delete($old_image);


                Brand::find($id)->update([
                    'brand_name' => $request->brand_name,
                    'brand_image' => $last_uploaded,
                    'updated_at' => Carbon::now()
                ]);

                return Redirect::back()->with('success', 'Brand Updated successfully');
            } else {
                /*  executes if only brand name is edited */
                Brand::find($id)->update([
                    'brand_name' => $request->brand_name,
                    'updated_at' => Carbon::now()
                ]);

                return Redirect::back()->with('success', 'Brand Updated successfully');
                # code...
            }
        }
    }

    public function destroy($id)
    {
        $image = Brand::findOrFail($id);
        $old_image = $image->brand_image;
        unlink($old_image);


        Brand::findOrFail($id)->delete();
        return Redirect::back()->with('success', 'Brand Deleted successfully');
    }
    public function multImage()
    {
        $images = Multipic::all();
        return view('admin.multipic.index', compact('images'));
    }
    public function storeImages(Request $request)
    {

        $image = $request->file('image');

        foreach ($image as $multi_img) {


            $random_name = hexdec(uniqid()) . '.' . $multi_img->getClientOriginalExtension();
            Image::make($multi_img)->resize(300, 300)->save('images/multi/' . $random_name);
            $last_uploaded = 'images/multi/' . $random_name;

            Multipic::insert([

                'image' => $last_uploaded,
                'created_at' => Carbon::now()
            ]);
        }


        return Redirect::back()->with('success', 'Images added successfully');
    }
    public function logout(){
        Auth::logout();
        return Redirect()->route('login')->with('success','User Logout');
    }
}
