<?php

namespace App\Http\Controllers\Public;

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
class CategoryController extends Controller
{
    protected $itemRepository;
    public function __construct(
        ItemRepository $itemRepository
        )
    {
        $this->itemRepository = $itemRepository;
    }

    public function index($locale, $category_url)
    {
    /* $project_budget = 7400000.22;
        echo gettype($project_budget);
			if($project_budget > 999999){
				$project_budget=number_format($project_budget / 1000000, 1) . 'm';
			}
        echo $project_budget;
        exit;*/
       
        if($locale == null){
            $locale = Config::get('app.locale');
        }
        $category = Category::where('url', $category_url)->first();
        if (!$category) {
            abort(404);  // вызовет страницу 404, которая будет обрабатываться по вашему кастомному примеру
        }

        $category_id = $category->id;
        $catLocale = $category->getLocalNameOne($locale, $category_id)->first();
        $items = $this->itemRepository->getCategoryItems($category_id);

        //$items = Item::get();
        $categories = Category::where('status', 'active')->get();
        //$categories = CategoriesLocalization::where('lang', 'ru')->get();
        /*return view('catalog.index', [
            'categories' => $categories,
            'items' => $items
        ]);*/
        /*
        echo "<pre>---";
       print_r($category);
        echo "_________</pre>";
        exit;
        */
       // echo "CAT::".$category_url."<br>";
       
        $pageTitle = $catLocale->name;
        $sideBarData = [];
        $sideBarData['title'] = $pageTitle;
        //////////////
        ///////////////
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home', $locale)],
           // ['title' => 'Category', 'url' => route('category', $locale)],
            ['title' => $pageTitle, 'url' => '']
        ];
        ////////////
        return view('catalog.category', [
            'breadcrumbs' => $breadcrumbs, 
            'locale' => $locale,
            'pageTitle' => $pageTitle,
            'sideBarData' => $sideBarData,
            'category' => $category,
            'categories' => $categories,
            'items' => $items
        ]);
        //return view('catalog.index');
    
    }
}
