<?php

use App\Models\Item;
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
// Route::get('/add', function () {
//         $item = new Item();
//         $item->name = 'lee';
//         $item->coin = 500;
//         $item->price = 400;
//         $item->save();
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['can:access-admin'])
        ->group(function () {
        Route::get('/items', function () {
        return view('items');
        })->name('items');
        Route::get('/users', function () {
            return view('users');
        })->name('users');
});
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
//     'isAdmin'
// ])->group(function () {
//     Route::get('/items', function () {
//         return view('items');
//     })->name('items');
//     Route::get('/users', function () {
//         return view('users');
//     })->name('users');
// });