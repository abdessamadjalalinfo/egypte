<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/index', [App\Http\Controllers\IndexController::class, 'index'])->name('index')->middleware('auth');
Route::get('/file', [App\Http\Controllers\FileController::class, 'file'])->name('file')->middleware('auth');
Route::get('/file/{id}', [App\Http\Controllers\FileController::class, 'showfile'])->name('showfile')->middleware('auth');


Route::get('/add_new_file', [App\Http\Controllers\FileController::class, 'addfile'])->name('addfile')->middleware('auth');
Route::Post('/storefile', [App\Http\Controllers\FileController::class, 'storefile'])->name('storefile')->middleware('auth');
Route::Post('/editfile', [App\Http\Controllers\FileController::class, 'editfile'])->name('editfile')->middleware('auth');

Route::Get('/searchfiles', [App\Http\Controllers\FileController::class, 'searchfiles'])->name('searchfiles')->middleware('auth');

Route::Post('/search', [App\Http\Controllers\FileController::class, 'search'])->name('search')->middleware('auth');

Route::GEt('/search', [App\Http\Controllers\FileController::class, 'search'])->name('search')->middleware('auth');

Route::Post('/storedocument', [App\Http\Controllers\FileController::class, 'storedocument'])->name('storedocument')->middleware('auth');



Route::get('/add_new_file', [App\Http\Controllers\FileController::class, 'addfile'])->name('addfile')->middleware('auth');

Route::get('/departement', [App\Http\Controllers\DepartementController::class, 'departement'])->name('departement')->middleware('auth');
Route::Post('/getsubdepartements', [App\Http\Controllers\DepartementController::class, 'getsubdepartements'])->name('getsubdepartements')->middleware('auth');
Route::Post('/gettype2', [App\Http\Controllers\DepartementController::class, 'gettype2'])->name('gettype2')->middleware('auth');



Route::get('/showdocuments', [App\Http\Controllers\FileController::class, 'showdocuments'])->name('showdocuments')->middleware('auth');
Route::get('/searchdocuments', [App\Http\Controllers\FileController::class, 'searchdocuments'])->name('searchdocuments')->middleware('auth');
Route::get('/addnewdocument', [App\Http\Controllers\FileController::class, 'addnewdocument'])->name('addnewdocument')->middleware('auth');
Route::get('/updatedocument', [App\Http\Controllers\FileController::class, 'updatedocument'])->name('updatedocument')->middleware('auth');

Route::delete('delete-multiple-document', [App\Http\Controllers\FileController::class, 'deletemultiple'])->name('category.multiple-delete')->middleware('auth');



Route::get('/addnewdocumentforfile/{id}', [App\Http\Controllers\FileController::class, 'addnewdocumentforfile'])->name('addnewdocumentforfile')->middleware('auth');



Route::Get('/getsubdepartements', [App\Http\Controllers\DepartementController::class, 'getsubdepartements'])->name('getsubdepartements')->middleware('auth');

Route::get('/edit_departement', [App\Http\Controllers\DepartementController::class, 'edit_departement'])->name('edit_departement')->middleware('auth');
Route::get('/edit_subdepartement', [App\Http\Controllers\DepartementController::class, 'edit_subdepartement'])->name('edit_subdepartement')->middleware('auth');

Route::get('/sub_departement', [App\Http\Controllers\DepartementController::class, 'sub_departement'])->name('sub_departement')->middleware('auth');
Route::Post('/storedepartement', [App\Http\Controllers\DepartementController::class, 'storedepartement'])->name('storedepartement')->middleware('auth');
Route::Post('/storesubdepartement', [App\Http\Controllers\DepartementController::class, 'storesubdepartement'])->name('storesubdepartement')->middleware('auth');

Route::Post('/storefile', [App\Http\Controllers\FileController::class, 'storefile'])->name('storefile')->middleware('auth');


Route::get('/deletedocument/{id}', [App\Http\Controllers\FileController::class, 'deletedocument'])->name('deletedocument')->middleware('auth');



Route::get('/Admins', [App\Http\Controllers\UserController::class, 'admins'])->name('admins')->middleware('auth');
Route::get('/viewers', [App\Http\Controllers\UserController::class, 'viewers'])->name('viewers')->middleware('auth');
Route::get('/editors', [App\Http\Controllers\UserController::class, 'editors'])->name('editors')->middleware('auth');
Route::get('/admin/{id}', [App\Http\Controllers\UserController::class, 'markasadmin'])->name('markasadmin')->middleware('auth');
Route::get('/editor/{id}', [App\Http\Controllers\UserController::class, 'markaseditor'])->name('markaseditor')->middleware('auth');
Route::get('/viewer/{id}', [App\Http\Controllers\UserController::class, 'markasviewer'])->name('markasviewer')->middleware('auth');


Route::get('addnewuser', [App\Http\Controllers\UserController::class, 'addnewuser'])->name('addnewuser')->middleware('auth');
