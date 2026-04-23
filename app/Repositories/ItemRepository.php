<?php

namespace App\Repositories;

use App\Models\Item;

class ItemRepository
{
    protected $model;

    public function __construct(Item $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return Item::all();
    }
    public function getCategoryItems($category_id)
    {
        return Item::where('category_id', $category_id)->get();
    }
}