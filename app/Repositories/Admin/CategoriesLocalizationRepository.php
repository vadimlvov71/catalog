<?php

namespace App\Repositories\Admin;

use App\Models\CategoriesLocalization;
use Illuminate\Http\Request;

class CategoriesLocalizationRepository
{
    
    public function setCategoriesLocalization($name, $categoryId): array
    {
        foreach($name as $key => $item){
            echo "key: ".$key."<br>";
            echo "item: ".$item."<br>";
            echo "$categoryId: ".$categoryId."<br>";
            CategoriesLocalization::create(
            [
                "category_id" => $categoryId, 
                "name" => $item, 
                "lang" => $key, 
                "description" => "test",
                "image" => "test Image"
            ]);
        }

        return ["result" => "test"];
    }
   
}