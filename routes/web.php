<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/service', [HomeController::class, 'service']);
Route::get('/blog', [HomeController::class, 'blog']);
Route::get('/blog/details', [BlogController::class, 'show']);
Route::get('/review', [HomeController::class, 'review'])->name('review');

Route::get('/shop/products', [HomeController::class, 'shop_product']);

Route::get('/admin_panel', [BlogController::class, 'admin_login'])->name('admin_panel.login');
Route::post('/admin_panel', [BlogController::class, 'admin_login_verify'])->name('admin_panel.login.verify');

 
    Route::get('/admin_panel/logout', [BlogController::class, 'admin_logout'])->name('admin_panel.logout');


Route::post('/review/commentstore', [BlogController::class, 'store_review_comment'])->name('reviews.comment.store');


 Route::middleware([AdminMiddleware::class])->group(function () {
    // Routes accessible only if admin session exists
    Route::get('/admin_panel/blogs/create', [BlogController::class, 'create'])->name('admin_panel.blogs.create');
    Route::post('/admin_panel/blogs/store', [BlogController::class, 'store'])->name('admin_panel.blogs.store');
    Route::get('/admin_panel/show_blogs', [BlogController::class, 'show_blogs'])->name('admin_panel.blog_show');
    Route::get('/admin_panel/blog_update/{id}', [BlogController::class, 'show_update'])->name('admin_panel.blog_show_update');
    Route::post('/admin_panel/blog_update_store/{id}', [BlogController::class, 'show_update_data'])->name('admin_panel.blog_show_update_store');
    Route::get('/admin_panel/blog_delete/{id}', [BlogController::class, 'show_delete'])->name('admin_panel.blog_show_delete');
    
    Route::get('/{title_url}', [BlogController::class, 'show'])->name('blog.show');

    Route::post('/comments/store', [BlogController::class, 'store_comment'])->name('comments.store');
Route::post('/reply/store', [BlogController::class, 'storeReply'])->name('reply.store');

    
    
     Route::get('/admin_panel/review/create', [BlogController::class, 'review_create'])->name('admin_panel.review.create');
  Route::post('/admin_panel/review/store', [BlogController::class, 'review_store'])->name('admin_panel.review.store');
 Route::get('/admin_panel/show_reviews', [BlogController::class, 'show_reviews'])->name('admin_panel.review_show');
  Route::get('/admin_panel/review_update/{id}', [BlogController::class, 'review_update'])->name('admin_panel.review_show_update');
   Route::post('/admin_panel/review_update_store/{id}', [BlogController::class, 'review_update_data'])->name('admin_panel.review_update_store');
   Route::get('/admin_panel/review_delete/{id}', [BlogController::class, 'review_delete'])->name('admin_panel.review_delete');
    

 });
 
//  Route::get('/{title_url}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/review/{title_url}', [BlogController::class, 'review_show'])->name('review.show');

Route::get('/{category}/{title_url}', [BlogController::class, 'show'])->name('blog.show');


