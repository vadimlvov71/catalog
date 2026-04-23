<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use App\Models\CategoriesLocalization;
use App\Enums\Language;
use App\Enums\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCategoryLocalizationRequest;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CategoriesLocalizationRepository;
use Session;

class CategoriesLocalizationController extends Controller
{
    public $categoryRepository;
    public $categoriesLocalizationRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        CategoriesLocalizationRepository $categoriesLocalizationRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoriesLocalizationRepository = $categoriesLocalizationRepository;
    }
    /*
    public function index($locale)
    {
        echo "locale: ".$locale."<br>";
        
        //$categories = Category::orderBy('id', 'desc')->get();
        $categories = Category::with('localizations')->get();
        /////
        $pageTitle = "Categories";
        $sideBarData = [];
        $sideBarData['title'] = $pageTitle;
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('admin.index', $locale)],
            ['title' => $pageTitle, 'url' => '']
        ];
        //////
        return view('admin.categories.index', compact('categories', 'locale', 'sideBarData', 'breadcrumbs'));
    }
*/
    public function create()
    {
        $languages = Language::cases();
        $status = Status::cases();
        //$categories = Category::all();
        $categories = Category::with('localizations')->get();
        /*$select = [];
        foreach($categories as $category){
            $select[$category->id] = $category->name;
            //$select[] = ["id" => $category->id, "name" => $category->name];
        }
        $select = Category::pluck('name', 'id');*/
        return view('admin.categories.create', compact(['categories', 'languages', 'status']));
    }

    public function store(Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        echo "</pre>";
       // exit;
        //$category["categoryId"] = "4";
        $name = $request->input('name');
        $category = $this->categoryRepository->setCatagory($request);
      
       echo "categoryId:".$category["categoryId"]."<br>";
       // exit;
        if($category["categoryId"]){
            $catLocal = $this->categoriesLocalizationRepository->setCategoriesLocalization($name, $category["categoryId"]);
            print_r($catLocal);
        }else{
            echo "error";
        }

        //exit;
        //$data =['category_id' => $request->category_id];
        
        $request->validate([
            //'name' => 'required',
            //'description' => 'required',
            //'category_id' => 'category_id',
        ]);

        return redirect()->route('admin.category.index')
                        ->with('success', 'Item created successfully.');
    }

    

    public function edit(string $locale, int $id)
    {
  
        ///->where('lang', $locale)
        $categoryLocalize = CategoriesLocalization::where('id', $id)->first(); 
       /* echo "<pre>";
        print_r($locale);
        echo "</pre>";
       exit;*/
        $categoryLocalizes = CategoriesLocalization::where('category_id', $categoryLocalize->category_id)
            //->where('lang', $locale)
            ->get(); // or firstOrFail()
        $category = Category::where('id', $categoryLocalize->category_id)->first(); 
        $categories = [];
        $categories = Category::all();
        $select = [];
        foreach($categories as $categoryItem){
            $select[$categoryItem->id] = $categoryItem->name;
        }
        //$select = Category::lists('name', 'id');
        $select = Category::pluck('name', 'id');
        $locales = Config::get('app.available_locales');
        $pageTitle = $categoryLocalize->name;
        $sideBarData = [];
        $sideBarData['title'] = $pageTitle;
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('admin.index', $locale)],
            ['title' => 'Category', 'url' => route('admin.category.index', $locale)],
            ['title' => $category->name, 'url' => route('admin.category.edit', [$locale, $category->id])],
            ['title' => $pageTitle, 'url' => '']
        ];
       /* echo "<pre>";
        print_r($categoryLocalizes);
        echo "</pre>";*/
        return view('admin.categories.locales.edit', compact('sideBarData', 'breadcrumbs',  'categoryLocalize', 'category', 'categories', 'select', 'categoryLocalizes', 'locale', 'locales'));
    }

    public function update($locale, $id, UpdateCategoryLocalizationRequest $request)
    {
       // $id = $request->input('id');
        $name = $request->input('name');
        $locale_id = $request->input('locale_id');
       
        /////////////////////////
      /* echo "locale:::".$locale."<br>";
       echo ":::".$name."<br>";
        echo ":locale_id::".$locale_id."<br>";
     echo ":::". $id;
    exit;*/
       // $id = 4;
       // $locale = "en";
        $item = CategoriesLocalization::find($locale_id);
          //  $item = CategoriesLocalization::where('category_id', $category_id)
           // ->where('lang', $locale)
           // ->first(); // or firstOrFail()
        //$item = Category::find($id);
        if ($item) {
            echo ":::".$item->name;
            $item->update($request->validated());
        } else {
            echo "no update <br>";
        }
       // exit;
        // redirect
        Session::flash('message', 'Successfully updated shark!');

        return redirect()->route('admin.category.local.edit', 
        ['locale' => $locale,
        'id' => $locale_id
        ])
                        ->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $Item)
    {
        $Item->delete();

        return redirect()->route('admin.index')
                        ->with('success', 'Item deleted successfully.');
    }
}