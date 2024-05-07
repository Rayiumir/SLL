<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function ($router) {

    //Users

    $router->get('/', \App\Livewire\Admin\Admin\Index::class);
    $router->get('/users', \App\Livewire\Admin\Users\Index::class)->name('users.index');
    $router->get('/users/create', \App\Livewire\Admin\Users\Create::class);
    $router->get('/users/edit/{id}', \App\Livewire\Admin\Users\Edit::class)->name('users.edit');
    $router->get('/users/trash', \App\Livewire\Admin\Users\Trash::class)->name('users.trash');

    //Roles

    $router->get('/roles', \App\Livewire\Admin\Roles\Index::class)->name('roles.index');
    $router->get('/roles/create', \App\Livewire\Admin\Roles\Create::class);

    // Category

    $router->get('/categories', \App\Livewire\Admin\Category\Index::class)->name('categories.index');
});
