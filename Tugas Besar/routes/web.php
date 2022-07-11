<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Rss;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "active" => 'about',
        "name" => "M. Akbar Ramadhan",
        "email" => "makbarramadhan62@gmail.com",
        "image" => "profil.jpg"
    ]);
});

Route::get('/', [PostController::class, 'index']);
Route::get('/home', [PostController::class, 'index']);
Route::get('/posts', [PostController::class, 'index']);
// Route::get('posts/{post:title}', [PostController::class, 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post Categories',
        "active" => 'categories',
        'categories' => Category::all()
    ]);
});

Route::get('/pokeapi', function(){
    return view('pokeapi', [
        "title" => "Pokemon API"]);
});