<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class CategoriesLocalization  extends Model
{
    use HasFactory;

    protected $table = 'categories_localizations';
    protected $fillable = [
        'name',
        'description',
        'item_image',
        'category_id',
        'lang'
    ];
    /**
     * @return [type]
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /*
    public function locals()
    {
        return $this->hasMany(Category::class);
    }*/
   
}
