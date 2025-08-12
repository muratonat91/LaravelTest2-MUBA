<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //
    protected $table = 'categories';

    protected $fillable = ['category_name', 'is_active'];


    // Bir kategorinin birden çok ürünü olabilir
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
