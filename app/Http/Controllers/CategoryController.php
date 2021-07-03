<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()

    {
        /* using Eloquent ORM
        $categories = Category::all(); or
        $categories = Category::latest()->get();
        */
        $categories = Category::latest()->paginate(8);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);

        //using query builder
        //$categories = DB::table('categories')->latest()->get(); //without pagination
        //$categories = DB::table('categories')->latest()->paginate(4);
        /*  $categories = DB::table('categories')
        ->join('users','categories.user_id','users.id')
        ->select('categories.*','users.name')
        ->latest()->paginate(4); */

        return view('admin.category.index', compact('categories', 'trashCat'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:255',

            ],
            [
                'category_name.required' => 'This field cannot be empty',
            ]
        );

        /* The first two methods implements Eloquent ORM


          ORM method 1 */

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()

        ]);
        return redirect()->back()->with('success', 'Category inserted successfully');



        // ORM method 2
        /*  $category = new Category();
        $category->category_name= $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();
        return redirect()->back()->with('success','Category inserted successfully');
 */
        /* Query Builer Method

        $data = array();
        $data['category_name'] =  $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->insert($data);
        return Redirect()->back()->with('success', 'Category inserted successfully'); */
    }
    public function editCat($id)
    {

        //$categories = Category::findOrFail($id); //eloquent method


        $categories = DB::table('categories')->where('id', $id)->first(); //using query builder
        return view('admin.category.edit', compact('categories'));
    }
    public function updateCat(Request $request, $id)
    {
        //using eloquent
        /* $update = Category::findOrFail($id)->update(
            [
            'category_name'=>$request->category_name,
            'user_id' => Auth::user()->id
         ] ); */

        //using query builder
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);
        return Redirect::route('categories.index')->with('success', 'Category updated successfully');
    }
    public function softDelete($id)
    {

        $delete = Category::findOrFail($id)->delete();
        return Redirect()->back()->with('success', 'Soft deletion succesful');
    }
    public function restoreDeleted($id)
    {
        $delete = Category::withTrashed()->findOrFail($id)->restore();
        return Redirect::back()->with('success', 'Restored Successfully');
    }
    public function destroy($id)
    {
        $p_delete = Category::onlyTrashed()->findOrFail($id)->forceDelete();
        return Redirect::back()->with('success', 'Category Permanently deleted');
    }
}
