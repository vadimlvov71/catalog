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
use Illuminate\Support\Facades\Log;

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
    public function create($locale, $categoryId)
    {
       /*   echo "locale: ".$locale."<br>";
        exit;*/
        $languages = Language::cases();
        $status = Status::cases();
        //$categories = Category::all();
        //$categories = Category::with('localizations')->get();
        $categories = Category::with('localizations')->get();
        $category = Category::where('id', $categoryId)
        ->first(); 
        ///
        $pageTitle = "Create";
        $sideBarData = [];
        $sideBarData['title'] = $pageTitle;
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('admin.index', $locale)],
            ['title' => 'Category', 'url' => route('admin.category.index', $locale)],
            ['title' => $category->name, 'url' => route('admin.category.edit', [$locale, $categoryId])],
            ['title' => $pageTitle, 'url' => '']
        ];
        ////
        /*$select = [];
        foreach($categories as $category){
            $select[$category->id] = $category->name;
            //$select[] = ["id" => $category->id, "name" => $category->name];
        }
        $select = Category::pluck('name', 'id');*/
        return view('admin.categories.locales.create', compact(['breadcrumbs', 'categories', 'sideBarData', 'languages', 'status', 'locale', 'categoryId']));
    }

    public function store(string $locale, int $categoryId,  UpdateCategoryLocalizationRequest $request)
    {
       /* echo "<pre>";
        print_r($request->all());
        echo "</pre>";
        echo "categoryId:".$categoryId."<br>";
        echo "locale:".$locale."<br>";
       exit;*/
        //$category["categoryId"] = "4";
       $name = $request->input('name');
       $description = $request->input('description');
       // $category = $this->categoryRepository->setCatagory($request);
      
        try {
            if($categoryId){
                $categoryLocale = CategoriesLocalization::create($request->validated());
            }else{
                echo "error";
            }
            return redirect()->route('admin.category.edit', [$locale, $categoryId])
                    ->with('success', 'Item created successfully.');

         } catch (\Exception $e) {
                Log::error('Error updating category: ' . $e->getMessage());
               // exit;
                return redirect()->back()
                            ->with('error', 'Failed to update locale category. Please try again.');
        }
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
        //$locales = Config::get('app.available_locales');
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
        return view('admin.categories.locales.edit', compact('sideBarData', 'breadcrumbs',  'categoryLocalize', 'category', 'categories', 'select', 'categoryLocalizes', 'locale'));
    }

    public function update($locale, $id, UpdateCategoryLocalizationRequest $request)
    {
       // $id = $request->input('id');
        $name = $request->input('name');
        $locale_id = $request->input('locale_id');
      /*  echo "<pre>";
        print_r($_POST);
        echo "</pre>";
       exit;*/
        /////////////////////////
      /* echo "locale:::".$locale."<br>";
       echo ":::".$name."<br>";
        echo ":locale_id::".$locale_id."<br>";
     echo ":::". $id;
    exit;*/
       // $id = 4;
       // $locale = "en";
        try {
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

            return redirect()->route('admin.category.locale.edit', 
            ['locale' => $locale,
            'locale_id_id' => $locale_id
            ])
            ->with('success', 'Item updated successfully.');
        } catch (\Exception $e) {
                Log::error('Error updating category: ' . $e->getMessage());
               // exit;
                return redirect()->back()
                            ->with('error', 'Failed to update locale category.' . $e->getMessage());
        }
    }

    public function destroy(Item $Item)
    {
        $Item->delete();

        return redirect()->route('admin.index')
                        ->with('success', 'Item deleted successfully.');
    }
}