<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\API\AdminJSONItemsController;
use App\Http\Controllers\Admin\API\AdminJSONCategoriesController;
use App\Http\Controllers\Admin\API\UserController;
use App\Http\Controllers\Admin\API\TranslationController;
use App\Http\Controllers\Admin\API\ImageController;
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
    Route::get('/manager_secret/{locale}/json/categories', [AdminJSONCategoriesController::class, 'getItems'])->name('admin.json.categories.index');
    Route::get('/manager_secret/check-unique', [AdminJSONCategoriesController::class, 'validateField']);
    // Другие защищённые маршруты здесь
    Route::post('/manager_secret/save-category', [AdminJSONCategoriesController::class, 'store']);
    Route::post('/manager_secret/image/upload', [ImageController::class, 'store']);
    Route::get('/manager_secret/{locale}/categories/edit/{id}', [AdminJSONCategoriesController::class, 'edit']);
    Route::post('/manager_secret/{locale}/categories/update/{id}', [AdminJSONCategoriesController::class, 'update']);
});
Route::get('/manager_secret/translations/{locale}', [TranslationController::class, 'getTranslations']);
//Route::middleware(['check.auth'])->group(function () {
  //  Route::get('/manager_secret/{locale}/json/items', [AdminJSONItemsController::class, 'getItems'])->name('admin.json.item.index');

//});