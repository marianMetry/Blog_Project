<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/categories' , CategoriesController::class);
    Route::resource('/posts' , PostsController::class);
    Route::get('/trashed' , [PostsController::class  , 'trashed'])->name('trashed.index');
    Route::get('/trashed/{id}' , [PostsController::class  , 'restore'])->name('trashed.restore');
    Route::resource('/tags'  ,  TagsController::class);

});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('users' , [UsersController::class  , 'index'])->name('users.index');
    Route::post('users/{user}/make-admin' , [UsersController::class  , 'makeAdmin'])->name('users.makeAdmin');
    Route::post('users/{user}/remove-admin' , [UsersController::class  , 'removeAdmin'])->name('users.removeAdmin');
});

Route::middleware(['auth'])->group(function () {

    Route::get('users/{user}/profile' , [UsersController::class  , 'edit'])->name('users.edit');
    Route::post('users/{user}/profile' , [UsersController::class  , 'update'])->name('users.update');


});
