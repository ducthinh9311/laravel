<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//use Illuminate\Http\Request
// //http://127.0.0.1:8000/product?name=bbb
// Route::get('product', function(Request $request){
//     echo 'Product List'. $request->query('name');
// });

// //http://127.0.0.1:8000/user/detail/13/nguyenvana
// //http://127.0.0.1:8000/user/detail/13/
// Route::get('user/detail/{id}/{name?}', function($id, $name = ''){
//     return 'User Detail: '.$id. $name;
// });
// Route::get('master', function () {
//     return view('client.layout.master');
// });
// Route::get('product', function () {
//     return view('client.pages.product.list');
// });
// Route::get('blog', function () {
//     return view('client.pages.blog.detail');
// });




// Route::get('master', function () {
//     return view('client.layout.master');
// });



Route::prefix('admin')->middleware('auth.admin')->name('admin.')->group(function () {

    //Client


    //user
    Route::get('user', [UserController::class, 'index'])->name('user.list');

    //product category
    Route::get('product_category', [ProductCategoryController::class, 'index'])->name('product_category.list');
    Route::get('product_category/add', [ProductCategoryController::class, 'add'])->name('product_category.add');
    Route::post('product_category/store', [ProductCategoryController::class, 'store'])->name('product_category.store');
    Route::get('product_category/{product_category}', [ProductCategoryController::class, 'detail'])->name('product_category.detail');
    Route::post('product_category/update{product_category}', [ProductCategoryController::class, 'update'])->name('product_category.update');
    Route::get('produc_category/destroy{product_category}', [ProductCategoryController::class, 'destroy'])->name('product_category.destroy');

    //product
    // Route::get('product', [ProductController::class, 'index'])->name('product.list');
    Route::resource('product', ProductController::class);
    Route::get('product/{product}/restore',[ProductController::class,'restore'])->name('product.restore');
    Route::post('product/slug', [ProductController::class, 'createSlug'])->name('product.create.slug');
    Route::post('product/ckeditor-upload-image', [ProductController::class, 'uploadImage'])->name('product.ckedit.upload.image');
});
Route::get('product-list',[HomeController::class,'index'])->name('home.index');
