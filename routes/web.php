<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Backend\Category\Categorylist;
use App\Http\Livewire\Backend\Tag\Taglist;

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
    return view('backend.dashboard');
});

/*
|--------------------------------------------------------------------------
| Backend Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register backend web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'admin'], function(){
    // -----:::Dashboard Route:::-----
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    });
    // -----:::Category Route:::-----
    Route::get('/category', Categorylist::class)->name('category.manage');
    Route::get('/tag', Taglist::class)->name('tag.manage');
});