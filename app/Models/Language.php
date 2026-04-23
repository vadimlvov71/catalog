<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class ItemsLocalization extends Model
{
    use HasFactory;
    protected $table = 'items_localizations';
    protected $fillable = [
        'name',
        'description',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}