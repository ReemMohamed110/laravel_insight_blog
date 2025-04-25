<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

require __DIR__.'/auth.php';
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('welcome');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard',[PostController::class,'index'] )->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('comment_store/{post}', [CommentController::class, 'store'])->name('comment_store');
    Route::post('like_store/{post}', [LikeController::class, 'store'])->name('like_store');
    
});






Route::get('about', function () {
    return view('about');
});
Route::get('contact', function () {
    return view('contact');
});
// Route::post('contact_action',[ContactController::class,'contactAction'] );
// Route::get('create_post', [PostController::class,'create']);
// Route::post('store_post', [PostController::class,'store']);
// Route::get('home', [PostController::class,'index']);
Route::controller(PostController::class)->group(function(){
Route::post('contact_action','contactAction')->middleware('auth');
Route::get('create_post','create')->name('create_post');
Route::get('my_posts','myPosts')->middleware('auth')->name('my_posts');
Route::get('post_dashboard','dashboard')->name('post_dashboard');
Route::post('store_post','store');
Route::delete('delete_post/{id}','destroy');
Route::get('edit_post/{id}','edit')->name('edit_post');
Route::put('update_post/{id}','update');
Route::get('single_post/{id}','show');
Route::get('/','index');
});
Route::controller(UserController::class)->group(function(){
    Route::get('add_admin','edit');
    Route::post('store_admin','update')->name('store_admin');
    
    });
