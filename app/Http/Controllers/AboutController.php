<?php

namespace App\Http\Controllers;


use App\Models\HomeAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{


    public function index()
    {
        $about = HomeAbout::latest()->get();
        return view('admin.about.index', compact('about'));
    }
    public function addAbout()
    {
        return view('admin.about.create');
    }
    public function store(Request $request)
    {
        $validation_rules =
            [
                'title' => 'required|max:25',
                'short_desc' => 'required|max:255',
                'long_desc' => 'required|max:255',

            ];
        $error_messages =
            [
                'title.required' => 'Please enter the title',

            ];

        $validate = Validator::make($request->all(), $validation_rules, $error_messages);

        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput();
        } else {

            HomeAbout::insert([
                'title' => $request->title,
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc               
             
            ]);

            return Redirect::route('about.index')->with('success', 'Content added successfully');
        }
    }
    public function edit($id)
    {

        $data = DB::table('home_abouts')->where('id', $id)->first(); //using query builder
        return view('admin.about.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        //using eloquent
        $update = HomeAbout::findOrFail($id)->update(
            [
                'title' => $request->title,
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc   
         ] );
       
        return Redirect::route('about.index')->with('success', 'About updated successfully');
    }
    public function destroy($id)
    {
        $delete = HomeAbout::findOrFail($id)->delete();
        return Redirect::back()->with('success', 'About deleted');
    }
}
