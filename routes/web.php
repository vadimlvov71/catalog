<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Public\IndexController;
use App\Http\Controllers\Public\ItemController;
use App\Http\Controllers\Public\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminItemsController;
use App\Http\Controllers\Admin\API\AdminJSONItemsController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminLocaleController;
use App\Http\Controllers\Admin\CategoriesLocalizationController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\StaticPagesController;
use App\Http\Controllers\Local\ChangeLanguageController;
use App\Http\Controllers\Error\ErrorsHandlingController;
use App\Http\Controllers\Error\ErrorsPageController;

use App\Http\Middleware\Localization;
use App\Http\Middleware\SetLocal;
use Illuminate\Support\Facades\Config;
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
/*
Route::get('/test-locale', function () {
    return [
        'locale' => app()->getLocale(),
        'value'  => __('admin.categories'),
        'raw'    => Lang::get('admin.categories'),
        'exists' => Lang::has('admin.categories'),
    ];
});*/
Route::group(['middleware' => ['guest']], function() {
    /**
     * Register Routes
     */
    Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

    /**
     * Login Routes
     */
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('login.perform');

});
//Auth::routes();
Route::middleware(['check.auth'])->group(function () {
    Route::get('/manager_secret', [AdminController::class, 'locale'])->name('admin.locale');
    Route::get('/manager_secret/{locale}', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/manager_secret/{locale}/items', [AdminItemsController::class, 'index'])->name('admin.item.index');
    //Route::get('/manager_secret/{locale}/json/items', [AdminJSONItemsController::class, 'getItems'])->name('admin.json.item.index');
    Route::match(['get', 'post'], '/manager_secret/{locale}/item/create', [AdminItemsController::class, 'create'])->name('admin.item.create');
    Route::post('/manager_secret/{locale}/item/store', [AdminItemsController::class, 'store'])->name('item.store');
    Route::post('/manager_secret/{locale}/item/update/{id}', [AdminItemsController::class, 'update'])->name('admin.item.update');
    Route::get('/manager_secret/item/show', [AdminItemsController::class, 'show'])->name('admin.item.show');
    Route::get('/manager_secret/{locale}/item/edit/{id}', [AdminItemsController::class, 'edit'])->name('admin.item.edit');
    Route::get('/manager_secret/locale/{locale}', [AdminItemsController::class, 'edit'])->name('admin.item.edit');
    Route::post('/manager_secret/{locale}/item/update-status', [AdminItemsController::class, 'updateStatus'])
    ->name('item.updateStatus');

    Route::get('/manager_secret/{locale}/categories', [AdminCategoriesController::class, 'index'])->name('admin.category.index');
    Route::get('/manager_secret/{locale}/categories/edit/{id}', [AdminCategoriesController::class, 'edit'])->name('admin.category.edit');
    Route::match(['get', 'post'], '/manager_secret/{locale}/categories/create', [AdminCategoriesController::class, 'create'])->name('admin.category.create');
    Route::post('/manager_secret/categories/store', [AdminCategoriesController::class, 'store'])->name('admin.category.store');
    Route::post('/manager_secret//{locale}/categories/update/{id}', [AdminCategoriesController::class, 'update'])->name('admin.category.update');
    Route::post('/manager_secret/{locale}/categories/update-status', [AdminCategoriesController::class, 'updateStatus'])
    ->name('category.updateStatus');
    Route::post('/manager_secret/{locale}/categories/update-index-status', [AdminCategoriesController::class, 'updateIndexStatus'])
    ->name('category.updateIndexStatus');

    Route::get('/manager_secret/{locale}/categories/name_locale/create/{catagoryId}', [CategoriesLocalizationController::class, 'create'])->name('admin.category.locale.create');
    Route::post('/manager_secret/{locale}/category/name_locale/store/{catagoryId}', [CategoriesLocalizationController::class, 'store'])->name('admin.category.locale.store');
    Route::get('/manager_secret/{locale}/categories/name_locale/edit/{id}', [CategoriesLocalizationController::class, 'edit'])->name('admin.category.locale.edit');
    Route::post('/manager_secret/{locale}/categories/name_locale/update/{id}', [CategoriesLocalizationController::class, 'update'])->name('admin.category.locale.update');
    
    Route::post('/manager_secret/image/upload/{type}/{id}', [ImageController::class, 'store'])->name('admin.image.store');

    
    Route::get('/manager_secret/locale/{locale}', [AdminLocaleController::class, 'set'])->name('admin.language.set');
    #Route::match(['get', 'post'], '/manager_secret/language/create', [AdminLanguagesController::class, 'create'])->name('admin.language.create');
    #Route::post('/manager_secret/language/store', [AdminLanguagesController::class, 'store'])->name('admin.language.store');
    /*Route::get('/{vue_capture?}', function () {
        return view('welcome');
    })->where('vue_capture', '[\/\w\.-]*');*/
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
    /*Route::group(['middleware' => ['cors']], function () {
    Route::get('/{locale?}', [IndexController::class, 'index']);
});*/
/*
Route::get('/{locale?}', function ($locale = null) {
    if (isset($locale) && in_array($locale, Config::get('app.available_locales'))) {
        app()->setLocale($locale);
       
    }else{
        echo "locale: ".$locale;
    }
    Route::get('/', [IndexController::class, 'index']);
   // print_r(Config::get('app.available_locales')); 
   // return view('welcome');
});
*/
//LOCAl
Route::get('locale/{locale}', [ChangeLanguageController::class, 'index'])->name('set-locale');
Route::get('/', [ChangeLanguageController::class, 'forcely'])->name('set-forcely-locale');
Route::get('/errors/wrong_locale', [ErrorsHandlingController::class, 'index'])->name('wrong-locale');
Route::get('/errors/no-permission-page/{locale}', [ErrorsPageController::class, 'noPermissionPage'])->name('no-permission-page');
///////////
//Route::prefix('{locale?}')->middleware('Localization')->group(function() {
//Route::group(['middleware' => ['check-locale' => ['except' => 'admin.index']], 'prefix' => '{locale?}'], function($locale) {

Route::group(['middleware' => ['check-locale'],'prefix' => '{locale?}'], function($locale) {

    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::get('/about', [StaticPagesController::class, 'about']);
    Route::get('/{category}', [CategoryController::class, 'index'])->name('category');
    Route::get('/{category}/{item_id}_{item}', [ItemController::class, 'index'])->name('item');
    Route::get('/category/{category}/brand/{brand}/{item}', [IndexController::class, 'item']);
});


