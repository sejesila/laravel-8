<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasswordController;
use App\Models\Multipic;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $about = DB::table('home_abouts')->get()->first();
    $images = Multipic::all();
    return view('home', compact('brands', 'about', 'images'));
});
Route::get('/home', function () {
    echo "this is home page";
});
Route::get('/about-us', function () {
    echo "this is about page";
})->name('abc');

//Category Controller
Route::get('/category', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/category', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'editCat']);
Route::post('/category/update/{id}', [CategoryController::class, 'updateCat']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'softDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restoreDeleted']);
Route::get('/category/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');


//Brand Controller
Route::get('/brand', [BrandController::class, 'index'])->name('brands.index');
Route::post('/brand/add', [BrandController::class, 'addBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'editBrand']);
Route::post('/brand/update/{id}', [BrandController::class, 'updateBrand']);
Route::get('/delete/brand/{id}', [BrandController::class, 'hardDelete']);
Route::post('/brand/update/{id}', [BrandController::class, 'updateBrand']);
Route::get('/brand/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');


//Multi image routes
Route::get('/multimage', [BrandController::class, 'multImage'])->name('images.index');
Route::post('/multimage', [BrandController::class, 'storeImages'])->name('image.store');


//Route::get('/contact', [ContactController::class,'index'])->middleware('checkage');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

/* Logout route */
Route::get('/user/logout', [BrandController::class, 'logout'])->name('user.logout');

//Slider routes

Route::get('/slider/home', [HomeController::class, 'slider'])->name('slider.index');
Route::get('/slider/add', [HomeController::class, 'addSlider'])->name('slider.add');
Route::post('/slider', [HomeController::class, 'store'])->name('sliders.store');

/* About us */
Route::get('/about-us', [AboutController::class, 'index'])->name('about.index');
Route::get('/about-us/add', [AboutController::class, 'addAbout'])->name('about.add');
Route::post('/about-us', [AboutController::class, 'store'])->name('about.store');
Route::get('/about-us/edit/{id}', [AboutController::class, 'edit']);
Route::post('/about-us/update/{id}', [AboutController::class, 'update']);
Route::get('/about-us/{id}', [AboutController::class, 'destroy'])->name('about.destroy');

//Portfolio
Route::get('/portfolio', [AboutController::class, 'portfolio'])->name('portfolio');

//Contact
Route::get('/admin/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/admin/contact/add', [ContactController::class, 'addContact'])->name('contact.add');
Route::get('/admin/message', [ContactController::class, 'storeMessage'])->name('message.index');

//Frontend contact us page
Route::get('/contact', [ContactController::class, 'contact_us'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'contactForm'])->name('contact.form');

//Change password
Route::get('/user/password',[PasswordController::class,'changePassword'])->name('password.change');
Route::post('/password/update',[PasswordController::class,'updatePassword'])->name('password.update');







