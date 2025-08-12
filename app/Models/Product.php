<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id'
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    // Her ürünün bir kategorisi vardır
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
