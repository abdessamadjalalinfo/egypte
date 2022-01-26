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
Route::get('/file', [App\Http\Controllers\FileController::class, 'file'])->name('file');
Route::get('/file/{id}', [App\Http\Controllers\FileController::class, 'showfile'])->name('showfile');


Route::get('/add_new_file', [App\Http\Controllers\FileController::class, 'addfile'])->name('addfile');
Route::Post('/storefile', [App\Http\Controllers\FileController::class, 'storefile'])->name('storefile');
Route::Post('/editfile', [App\Http\Controllers\FileController::class, 'editfile'])->name('editfile');

Route::Get('/searchfiles', [App\Http\Controllers\FileController::class, 'searchfiles'])->name('searchfiles');

Route::Post('/search', [App\Http\Controllers\FileController::class, 'search'])->name('search');

Route::GEt('/search', [App\Http\Controllers\FileController::class, 'search'])->name('search');

Route::Post('/storedocument', [App\Http\Controllers\FileController::class, 'storedocument'])->name('storedocument');



Route::get('/add_new_file', [App\Http\Controllers\FileController::class, 'addfile'])->name('addfile');

Route::get('/departement', [App\Http\Controllers\DepartementController::class, 'departement'])->name('departement');
Route::Post('/getsubdepartements', [App\Http\Controllers\DepartementController::class, 'getsubdepartements'])->name('getsubdepartements');
Route::Post('/gettype2', [App\Http\Controllers\DepartementController::class, 'gettype2'])->name('gettype2');



Route::get('/showdocuments', [App\Http\Controllers\FileController::class, 'showdocuments'])->name('showdocuments');
Route::get('/searchdocuments', [App\Http\Controllers\FileController::class, 'searchdocuments'])->name('searchdocuments');
Route::get('/addnewdocument', [App\Http\Controllers\FileController::class, 'addnewdocument'])->name('addnewdocument');
Route::get('/updatedocument', [App\Http\Controllers\FileController::class, 'updatedocument'])->name('updatedocument');

Route::delete('delete-multiple-document', [App\Http\Controllers\FileController::class, 'deletemultiple'])->name('category.multiple-delete');



Route::get('/addnewdocumentforfile/{id}', [App\Http\Controllers\FileController::class, 'addnewdocumentforfile'])->name('addnewdocumentforfile');



Route::Get('/getsubdepartements', [App\Http\Controllers\DepartementController::class, 'getsubdepartements'])->name('getsubdepartements');

Route::get('/edit_departement', [App\Http\Controllers\DepartementController::class, 'edit_departement'])->name('edit_departement');
Route::get('/edit_subdepartement', [App\Http\Controllers\DepartementController::class, 'edit_subdepartement'])->name('edit_subdepartement');

Route::get('/sub_departement', [App\Http\Controllers\DepartementController::class, 'sub_departement'])->name('sub_departement');
Route::Post('/storedepartement', [App\Http\Controllers\DepartementController::class, 'storedepartement'])->name('storedepartement');
Route::Post('/storesubdepartement', [App\Http\Controllers\DepartementController::class, 'storesubdepartement'])->name('storesubdepartement');

Route::Post('/storefile', [App\Http\Controllers\FileController::class, 'storefile'])->name('storefile');


Route::get('/deletedocument/{id}', [App\Http\Controllers\FileController::class, 'deletedocument'])->name('deletedocument');



Route::get('/Admins', [App\Http\Controllers\UserController::class, 'admins'])->name('admins');
Route::get('/viewers', [App\Http\Controllers\UserController::class, 'viewers'])->name('viewers');
Route::get('/editors', [App\Http\Controllers\UserController::class, 'editors'])->name('editors');
Route::get('/admin/{id}', [App\Http\Controllers\UserController::class, 'markasadmin'])->name('markasadmin');
Route::get('/editor/{id}', [App\Http\Controllers\UserController::class, 'markaseditor'])->name('markaseditor');
Route::get('/viewer/{id}', [App\Http\Controllers\UserController::class, 'markasviewer'])->name('markasviewer');


Route::get('addnewuser', [App\Http\Controllers\UserController::class, 'addnewuser'])->name('addnewuser');
