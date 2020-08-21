<?php

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
Route::get('logout', 'Auth\LoginController@logout', function () {
  return abort(404);
});
Route::get('/', function () {
    return view('home');
});

   //Roles
 Route::group(['middleware' => 'isSystem'], function () {
   Route::get('admin/roles', ['as'=>'admin.roles','uses'=>'adminRoleController@index']);
   Route::post('admin/roles', ['as'=>'admin.roles','uses'=>'adminRoleController@store']);
  });

 Route::group(['middleware' => 'admin'], function () {
   Route::get('admin/users', ['as'=>'admin.users','uses'=>'adminController@showAllusers']);
   Route::resource('admin','adminController');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
