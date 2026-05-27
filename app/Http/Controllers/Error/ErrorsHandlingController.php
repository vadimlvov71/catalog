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
class ErrorsHandlingController extends Controller
{
    protected $itemRepository;
    public function __construct(
        ItemRepository $itemRepository
        )
    {
        $this->itemRepository = $itemRepository;
    }

    public function index()
    {
        $items = config('languages.locales');
       // echo "<pre>";
       // print_r($items);
      //  exit;
        $pageTitle = "Locale error";
        $sideBarData = [];
        $sideBarData['title']='First';
        $categories = [];
        $locale = "";
         $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home', $locale)],
           // ['title' => 'Category', 'url' => route('category', $locale)],
            ['title' => $pageTitle, 'url' => '']
        ];
        return view('errors.wrong.locale', [
            'pageTitle' => $pageTitle,
            'breadcrumbs' => $breadcrumbs, 
            'items' => $items,
            'sideBarData' => $sideBarData,
            'categories' => $categories,
            'locale' => $locale,
        ]);
    }
    public function notFound($locale)
    {
        app()->setLocale($locale); // Устанавливаем локаль для перевода
        // Возвращаем представление с переводами
        return response()->view('errors.404', [], 404);
    }
}
