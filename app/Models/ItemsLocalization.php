<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class ItemsLocalization extends Model
{
    use HasFactory;

    protected $table = 'items_localizations';

    /**
     * @return [type]
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    /*
    public function locals()
    {
        return $this->hasMany(Category::class);
    }*/
   
}