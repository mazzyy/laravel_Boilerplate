<?php

use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Models\company_information;
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

// Route::get('/home', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth/login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Roles And Permisions
Route::get('/roles', [App\Http\Controllers\RolesController::class, 'index'])->name('roles');
Route::post('/roles-store', [App\Http\Controllers\RolesController::class, 'store'])->name('roles-store');
Route::post('/delete-roles', [App\Http\Controllers\RolesController::class, 'delete'])->name('delete-roles');
Route::post('/edit-roles', [App\Http\Controllers\RolesController::class, 'editRoles'])->name('edit-roles');
Route::post('/update-roles', [App\Http\Controllers\RolesController::class, 'updateRoles'])->name('update-roles');
Route::post('/get-roles-menu', [App\Http\Controllers\RolesController::class, 'getRoleMenus'])->name('get-roles-menu');
Route::post('/sotre-roles-menu', [App\Http\Controllers\RolesController::class, 'storeRoleMenus'])->name('sotre-roles-menu');

// User
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::post('/users', [App\Http\Controllers\UserController::class, 'storeUser'])->name('users');
Route::post('/delete-user', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('delete-user');
Route::post('/edit-user', [App\Http\Controllers\UserController::class, 'editUser'])->name('edit-user');
Route::post('/update-user', [App\Http\Controllers\UserController::class, 'updateUser'])->name('update-user');

//Menu Routes
Route::get('/menu-routes', [App\Http\Controllers\MenusRoutesController::class, 'index'])->name('menu-routes');
Route::post('/menu-routes', [App\Http\Controllers\MenusRoutesController::class, 'store'])->name('menu-routes');
Route::post('/delete-menu-routes', [App\Http\Controllers\MenusRoutesController::class, 'destroy'])->name('delete-menu-routes');
Route::post('/edit-menu-routes', [App\Http\Controllers\MenusRoutesController::class, 'edit'])->name('edit-menu-routes');
Route::post('/update-menu-routes', [App\Http\Controllers\MenusRoutesController::class, 'update'])->name('update-menu-routes');

//Menu Managment
Route::get('/menus', [App\Http\Controllers\MenuController::class, 'index'])->name('menus');
Route::post('/menus', [App\Http\Controllers\MenuController::class, 'store'])->name('menus');
Route::post('/delete-menu', [App\Http\Controllers\MenuController::class, 'destroy'])->name('delete-menu');
Route::post('/edit-menu', [App\Http\Controllers\MenuController::class, 'edit'])->name('edit-menu');
Route::post('/update-menu', [App\Http\Controllers\MenuController::class, 'update'])->name('update-menu');


Route::get('/email-setting', [App\Http\Controllers\EmailSettingsController::class, 'index'])->name('email-setting');
Route::post('/email-setting', [App\Http\Controllers\EmailSettingsController::class, 'store'])->name('email-setting');
Route::post('/delete-email-setting', [App\Http\Controllers\EmailSettingsController::class, 'destroy'])->name('delete-email-setting');
Route::post('/edit-email-setting', [App\Http\Controllers\EmailSettingsController::class, 'edit'])->name('edit-email-setting');
Route::post('/update-email-setting', [App\Http\Controllers\EmailSettingsController::class, 'update'])->name('update-email-setting');

Route::get('/company-info', function () {return view('admin.companyinfo.index',['data'  => company_information::first()]);})->name('company-info');
Route::post('/company-info', [App\Http\Controllers\HomeController::class, 'businessInfo'])->name('company-info');
Route::get('/login-settings', [App\Http\Controllers\HomeController::class, 'loginSettings'])->name('login-settings');
Route::post('/login-settings', [App\Http\Controllers\HomeController::class, 'saveLoginSettings'])->name('login-settings');

Route::get('/user-logs', [App\Http\Controllers\HomeController::class, 'userLogs'])->name('user-logs');
Route::post('/get-user-location', [App\Http\Controllers\HomeController::class, 'getUserLocation'])->name('get-user-location');

