<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemsLocalization;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = [
        'name',
        'description',
        'url',
        'price',
        'category_id',
        'image',
        'preview',
        'status',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function itemsLocals()
    {
        return $this->hasMany(ItemsLocalization::class);
    }
    public function getLocalName($lang)
    {
        return $this->hasOne(ItemsLocalization::class)->where('lang', '=', $lang)->get()->toArray();
    }
    public function getLocalNameOne($lang)
    {
        return $this->itemsLocals()->where('lang', $lang)->first()?->name ?? '';
        /*return $this->hasOne(ItemsLocalization::class)->where([
            ['lang', '=', $lang],
           ['item_id', '=', $item_id],
        ]);*/
    }
}
