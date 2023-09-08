<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    return view('layout/master');
})->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');
Route::view('newUser', '/user.addUser')->name('newForm')->middleware('auth');  //Shows the file addUser.blade.php when the newUser
                                                    // route is hit
Route::post('addUser', [UserController::class, 'addUser'])->name('add')->middleware('auth');
Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('auth');
Route::delete('delete-all', [UserController::class, 'removeMulti'])->middleware('auth');
Route::get('/view/{id}', [UserController::class, 'updateForm'])->name('updateForm')->middleware('auth'); //shows the 
            //'updateUser.blade.php. when it is called, meaning the form with filled values
Route::post('update/{id}', [UserController::class, 'updateUser'])->name('updateUser')->middleware('auth');
            //runs when the update is clicked.
Route::get('/delete/{id}', [UserController::class, 'deleteUser'])->name('deleteUser')->middleware('auth');
Route::get('deleteAll', [UserController::class, 'deleteAllUsers'])->name('deleteAll')->middleware('auth');  



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    

});

require __DIR__.'/auth.php';
