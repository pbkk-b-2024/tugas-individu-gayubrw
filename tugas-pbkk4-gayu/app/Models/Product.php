<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'stock', 'status', 'image_url', 'category_id', 'size_guide_url', 'detail'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}