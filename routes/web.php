<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
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
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('layout/master');
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    
    Route::group(['middleware' => ['can:manage users']], function(){
        Route::view('newUser', '/user.addUser')->name('newForm');  //Shows the file addUser.blade.php when the newUser
                                                    // route is hit

        Route::controller(UserController::class)->group(function(){
            Route::post('addUser','addUser')->name('add');
            Route::get('/users', 'index')->name('users');
            Route::post('/users/getUsers/', 'getUsers')->name('getUsers'); 
            Route::delete('delete-all', 'removeMulti');
            Route::get('/view/{id}', 'updateForm')->name('updateForm'); //shows the 
                        //'updateUser.blade.php. when it is called, meaning the form with filled values
            Route::post('update/{id}', 'updateUser')->name('updateUser');
                        //runs when the update is clicked.  
        });

        Route::view('newRole', '/roles.addRole')->name('newRoleForm'); 
        Route::controller(RolesController::class)->group(function(){
            Route::get('/roles', 'index')->name('roles');
            Route::post('/roles/getRoles/', 'getRoles')->name('getRoles');
            Route::post('/addRole','addRole')->name('addRole');
            Route::get('/role/{id}', 'updateRoleForm')->name('updateRoleForm');
            Route::post('updateRole/{id}', 'updateRole')->name('updateRole');
            Route::delete('deleteRoles', 'removeRoles');
        });

    }); 

});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
