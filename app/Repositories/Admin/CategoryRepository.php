<?php

namespace App\Repositories\Admin;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRepository
{
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function setCatagory($request): array
    {
        $url = $request->input('url');
        $status = $request->input('status');
        
        $category = Category::create(
            [
                "status" => $status, 
                "name" => $url, 
                "url" => $url, 
                "description" => "test",
                "image" => "test Image"
            ]);

        return ["result" => "test", "categoryId" => $category->id];
    }
    public function getCategoryItems($category_id)
    {
        return Item::where('category_id', $category_id)->get();
    }
}