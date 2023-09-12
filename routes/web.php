<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductCategory;

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




Route::get('master', function () {
    return view('client.layout.master');
});


Route::prefix('admin')->name('admin.')->group(function () {

    //user
    Route::get('user', [UserController::class, 'index'])->name('user.list');

    //product category
    Route::get('product_category', [ProductCategory::class, 'index'])->name('product_category.list');
    Route::get('product_category/add', [ProductCategory::class, 'add'])->name('product_category.add');
    Route::post('product_category/store', [ProductCategory::class, 'store'])->name('product_category.store');
    Route::get('product_category/{id}', [ProductCategory::class, 'detail'])->name('product_category.detail');
    Route::post('product_category/update{id}', [ProductCategory::class, 'update'])->name('product_category.update');
    Route::get('produc_category/destroy{id}', [ProductCategory::class, 'destroy'])->name('product_category.destroy');

    //product
    // Route::get('product', [ProductController::class, 'index'])->name('product.list');
    Route::resource('product', ProductController::class);
    Route::post('product/slug', [ProductController::class, 'createSlug'])->name('product.create.slug');
});
