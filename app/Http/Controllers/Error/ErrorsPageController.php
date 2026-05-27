<?php

namespace App\Http\Controllers\Error;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoriesLocalization;
use App\Models\Item;
use App\Repositories\ItemRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
/**
* @author Vadim Podolyan <vadim.podolyan@gmail.com>

 * A websites catalog with a localization or without it
 */
class ErrorsPageController extends Controller
{
    public function noPermissionPage($locale)
    {
        app()->setLocale($locale); // Устанавливаем локаль для перевода
        // Возвращаем представление с переводами
        return response()->view('errors.no-permission', [], 404);
    }
}
