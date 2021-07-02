<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    echo "this is home page";
});
Route::get('/about-us', function () {
    echo "this is about page";
})->name('abc');

//Category Controller
Route::get('/category/all',[CategoryController::class,'allCat'])->name('all.category');

Route::post('/category/add',[CategoryController::class,'addCat'])->name('store.category');

Route::get('/category/edit/{id}',[CategoryController::class,'editCat']);

Route::post('/category/update/{id}',[CategoryController::class,'updateCat']);

Route::get('/softdelete/category/{id}',[CategoryController::class,'softDelete']);

Route::get('/category/restore/{id}',[CategoryController::class,'restoreDeleted']);

Route::get('/pdelete/category/{id}',[CategoryController::class,'hardDelete']);


//Brand Controller
Route::get('/brand/all',[BrandController::class,'index'])->name('all.brands');
Route::post('/brand/add',[BrandController::class,'addBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'editBrand']);
Route::post('/brand/update/{id}',[BrandController::class,'updateBrand']);
Route::get('/delete/brand/{id}',[BrandController::class,'hardDelete']);

Route::post('/brand/update/{id}',[BrandController::class,'updateBrand']);





Route::get('/contact', [ContactController::class,'index'])->middleware('checkage');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users  = User::all();//This is Eloquent ORM format
    // $users = DB::table('users')->get();//Query builder format
    return view('dashboard',compact('users'));
})->name('dashboard');
