<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\CategoriesLocalization;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'status',
        'url', 
        'image'
    ];
    /**
     * @return [type]
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
   /* public function locals(){
        return $this->belongsTo(CategoriesLocalization::class);
    }*/
    
    public function localizations()
    {
        return $this->hasMany(CategoriesLocalization::class);
    }
    public function getLocalName($lang)
    {
        return $this->localizations()->where('lang', $lang)->first()?->name ?? '';
    }
    public function getLocalName1()
    {
        return $this->localizations()->first()?->name ?? '';
    }
    public function getLocalNameOne($lang, $category_id)
    {
        return $this->hasOne(CategoriesLocalization::class)->where([
            ['lang', '=', $lang],
            ['category_id', '=', $category_id],
        ]);
        //return $this->locals()->where('lang', '=', $lang)->get();
    }
    public function getLocalId($lang)
    {
        return $this->localizations()->where('lang', $lang)->first()?->id ?? '';
    }
}
