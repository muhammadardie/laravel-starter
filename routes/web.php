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
Route::get('/', function() {
	return redirect('/dashboard');
});

Route::group(['middleware' => ['auth', 'web', 'check.route']], function () {
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

	// USER MANAGEMENT
	Route::prefix('user-management')->group(function () {

		// role
		Route::get('/role/ajaxDatatable', 'UserManagement\RoleController@ajaxDatatable')->name('role.ajaxDatatable');
		Route::resource('role', 'UserManagement\RoleController', ['names' => 'role']);

		// menu
		Route::get('/menu/ajaxDatatable', 'UserManagement\MenuController@ajaxDatatable')->name('menu.ajaxDatatable');
		Route::resource('menu', 'UserManagement\MenuController', ['names' => 'menu']);

		// permission
		Route::get('/permission/ajaxDatatable', 'UserManagement\PermissionController@ajaxDatatable')->name('permission.ajaxDatatable');
		Route::resource('permission', 'UserManagement\PermissionController', ['names' => 'permission']);

		// role-menu
		Route::get('/role-menu/ajaxDatatable', 'UserManagement\RoleMenuController@ajaxDatatable')->name('role-menu.ajaxDatatable');
		Route::resource('role-menu', 'UserManagement\RoleMenuController', ['names' => 'role-menu']);

		// menu-permission
		Route::get('/menu-permission/ajaxDatatable', 'UserManagement\MenuPermissionController@ajaxDatatable')->name('menu-permission.ajaxDatatable');
		Route::resource('menu-permission', 'UserManagement\MenuPermissionController', ['names' => 'menu-permission']);	

		// user
		Route::get('/user/ajaxDatatable', 'UserManagement\UserController@ajaxDatatable')->name('user.ajaxDatatable');
		Route::put('/user/changePassword/{id}', 'UserManagement\UserController@changePassword')->name('user.changePassword');
		Route::put('/user/changeProfile/{id}', 'UserManagement\UserController@changeProfile')->name('user.changeProfile');
		Route::resource('user', 'UserManagement\UserController', ['names' => 'user']);
		
	});

});

Auth::routes();