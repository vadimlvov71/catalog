<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoriesLocalization;
use App\Models\Item;
use App\Repositories\ItemRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

/**
* @author Vadim Podolyan <vadim.podolyan@gmail.com>
 */
class StaticPagesController extends Controller
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
        $items = $this->itemRepository->getAll();

        //$items = Item::get();
        //$categories = Category::where('status', 'active')->get();
        $categories = CategoriesLocalization::where('lang', 'ru')->get();
        /*return view('catalog.index', [
            'categories' => $categories,
            'items' => $items
        ]);*/
        return view('catalog.child', [
            'categories' => $categories,
            'items' => $items
        ]);
        //return view('catalog.index');
    }
    public function about()
    {
        $items = $this->itemRepository->getAll();

        //$items = Item::get();
        //$categories = Category::where('status', 'active')->get();
        //$categories = CategoriesLocalization::where('lang', 'ru')->get();
        /*return view('catalog.index', [
            'categories' => $categories,
            'items' => $items
        ]);*/
        /*return view('catalog.child', [
            'categories' => $categories,
            'items' => $items
        ]);*/
        //return view('catalog.index');
        return __("general.hello_world");
    }
  
}
