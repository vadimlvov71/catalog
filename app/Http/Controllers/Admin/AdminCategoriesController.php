<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use App\Models\CategoriesLocalization;
use App\Enums\Language;
use App\Enums\Status;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CategoriesLocalizationRepository;
use Session;
use Illuminate\Support\Facades\Log;

class AdminCategoriesController extends Controller
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

    public function create(string $locale,  int $catagoryId)
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
        return view('admin.categories.create', compact(['categories', 'languages', 'status', 'locale', 'sideBarData', 'breadcrumbs']));
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

    public function show(Item $Item)
    {
        return view('admin.show', compact('Item'));
    }

    public function edit(string $locale, int $id)
    {
        $category = Category::where('id', $id)
        ->first(); 
        
        $categoryLocalizes = CategoriesLocalization::where('category_id', $id)
            //->where('lang', $locale)
            ->get(); // or firstOrFail()
        
        $categories = Category::all();
        $select = [];
        foreach($categories as $categoryItem){
            $select[$categoryItem->id] = $categoryItem->name;
        }
         /////


        //$select = Category::lists('name', 'id');
        $select = Category::pluck('name', 'id');
        $pageTitle = "Cat";
        $sideBarData = [];
        $sideBarData['title'] = $pageTitle;
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('admin.index', $locale)],
            ['title' => 'Category', 'url' => route('admin.category.index', $locale)],
            ['title' => $pageTitle, 'url' => '']
        ];
       /* echo "<pre>";
        print_r($category);
        echo "</pre>";*/
        return view('admin.categories.edit', compact('breadcrumbs', 'category', 'sideBarData', 'categories', 'select', 'categoryLocalizes', 'locale'));
    }

    public function update(string $locale, int $id, UpdateCategoryRequest $request)
    {
       /* $id = $request->input('id');
        $name = $request->input('name');
        $locale = $request->input('locale');*/
        /////////////
        /*echo "<pre>";
        print_r($request->all());
        echo "</pre>";
         echo "locale:".$locale."<br>";
         echo "id:".$id."<br>";
       exit;*/
      
        ///////////////////
       /* echo "<pre>";
        print_r($request->validated());
        echo "</pre>";
      exit;*/
      
           
        ////////////////
        // Store the file in storage\app\public folder
       /* $request->validate([
           // 'file_upload' => 'required|mimes:jpg,png,jpeg|max:2048',
            'name' => 'required',
            'description' => 'required',
        ]);*/
        $imageNameHashed = "test";
        if ($request->hasFile('file_upload')) {
            $max_size = (int) ini_get('upload_max_filesize') * 1000;
            $file = $request->file('file_upload');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('uploads', 'public');
            $imageNameHashed = $file->hashName(); // Generate a unique, random name...
            //$extension = $file->extension(); // Determine the file's extension based on the file's MIME type...
        }else{
            echo "no file <br>";
        }
     
        /////////////////////////
      
     //  echo ":::".$name;
     //echo ":::". $id;
     //exit;
        //$item = $this->categoryRepository
        //$item = CategoriesLocalization::find($id);
          //  $item = CategoriesLocalization::where('category_id', $category_id)
           // ->where('lang', $locale)
           // ->first(); // or firstOrFail()
        try {
            $item = Category::find($id);
        
            echo ":::".$item->name."<br>";
            $item->update($request->validated());

             Log::info('Category updated successfully: ' . $item->id);

            return redirect()->route('admin.category.edit', ['locale' => $locale, 'id' => $item->id])
                           ->with('success', 'category updated successfully!');


            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                Log::warning('category not found: ' . $id);
               /* return redirect()->route('admin.category.index', ['locale' => $locale])
                            ->with('error', 'category not found.');*/

            } catch (\Exception $e) {
                Log::error('Error updating category: ' . $e->getMessage());
               // exit;
                return redirect()->back()
                            ->with('error', 'Failed to update category. Please try again.');
            }
       // exit;
        // redirect
   
    }
    public function updateStatus($locale, Request $request)
    {
        $category_id = $request->input('category_id');
        $name = $request->input('name');
       // $locale = $request->input('locale');
        $status = $request->input('status');
        echo "category_id:::".$category_id."<br>";
        echo "status:::".$status."<br>";
        echo "locale:::".$locale."<br>";
        //exit;
        /////////////
        $item = Category::findOrFail($category_id);
        if ($item) {
            echo ":::".$item->name;
            $item->update(['status' => $status]);
        } else {
            echo "no update <br>";
        }
        //exit;
        // redirect
        Session::flash('message', 'Successfully updated shark!');

        return redirect()->route('admin.category.index', ['locale' => $locale])
                        ->with('success', 'Status updated successfully.');
                        
        ///////////////////
       /* echo "<pre>";
        print_r($request->all());
        echo "</pre>";*/
    }
    public function destroy(Item $Item)
    {
        $Item->delete();

        return redirect()->route('admin.index')
                        ->with('success', 'Item deleted successfully.');
    }
}