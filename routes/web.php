<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    return view('home',compact('brands'));
});
Route::get('/home', function () {
    echo "this is home page";
});
Route::get('/about-us', function () {
    echo "this is about page";
})->name('abc');

//Category Controller
Route::get('/category',[CategoryController::class,'index'])->name('categories.index');
Route::post('/category',[CategoryController::class,'store'])->name('categories.store');
Route::get('/category/edit/{id}',[CategoryController::class,'editCat']);
Route::post('/category/update/{id}',[CategoryController::class,'updateCat']);
Route::get('/softdelete/category/{id}',[CategoryController::class,'softDelete']);
Route::get('/category/restore/{id}',[CategoryController::class,'restoreDeleted']);
Route::get('/category/{id}',[CategoryController::class,'destroy'])->name('categories.destroy');


//Brand Controller
Route::get('/brand',[BrandController::class,'index'])->name('brands.index');
Route::post('/brand/add',[BrandController::class,'addBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class,'editBrand']);
Route::post('/brand/update/{id}',[BrandController::class,'updateBrand']);
Route::get('/delete/brand/{id}',[BrandController::class,'hardDelete']);
Route::post('/brand/update/{id}',[BrandController::class,'updateBrand']);
Route::get('/brand/{id}',[BrandController::class,'destroy'])->name('brands.destroy');


//Multi image routes
Route::get('/multimage',[BrandController::class,'multImage'])->name('images.index');
Route::post('/multimage',[BrandController::class,'storeImages'])->name('image.store');



Route::get('/contact', [ContactController::class,'index'])->middleware('checkage');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {    
    return view('admin.index');})->name('dashboard');

/* Logout route */
Route::get('/user/logout',[BrandController::class,'logout'])->name('user.logout');

Route::get('/home/slider',[HomeController::class,'slider'])->name('home.slider');

Route::get('/slider/add',[HomeController::class,'addSlider'])->name('slider.add');
Route::post('/slider',[HomeController::class,'store'])->name('sliders.store');
