<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\API\AdminJSONItemsController;
use App\Http\Controllers\Admin\API\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Route::middleware('auth:sanctum')->get('/manager_secret/{locale}/user', [UserController::class, 'currentUser'])->name('admin.api.user');

Route::middleware('auth:sanctum')->get('/manager_secret/{locale}/user', function (Request $request) {
    return $request->user();
});
//Route::get('/user', [UserController::class, 'currentUser'])->name('admin.json.user');
/*
Route::middleware('auth:sanctum')->get('/manager_secret/{locale}/json/items', [AdminJSONItemsController::class, 'getItems']) {
    return $request->user();
});*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/manager_secret/{locale}/json/items', [AdminJSONItemsController::class, 'getItems'])->name('admin.json.item.index');
    // Другие защищённые маршруты здесь
});
//Route::middleware(['check.auth'])->group(function () {
  //  Route::get('/manager_secret/{locale}/json/items', [AdminJSONItemsController::class, 'getItems'])->name('admin.json.item.index');

//});