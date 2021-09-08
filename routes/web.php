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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/admin",[\App\Http\Controllers\Admin\ProjectController::class,"index"])->name("admin")->middleware("role:Admin");
Route::prefix('/admin')->group(function () {
     Route::resource("project",\App\Http\Controllers\Admin\ProjectController::class)->middleware("role:Admin");

});
Route::get("/panel",[\App\Http\Controllers\Panel\HomeController::class,'index'])->name("panel")->middleware("role:User");
Route::prefix('panel')->group(function () {
  Route::get("/project/{id}",[\App\Http\Controllers\Panel\ProjectController::class,'index'])->name("projectInfo")->middleware("role:User");;
  Route::resource("/project/{pid}/task",\App\Http\Controllers\Panel\TaskController::class)->middleware("role:User");


});
