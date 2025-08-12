<?php

namespace App\Library\Repository\Interface;

use App\Http\Requests\testicin;
use Illuminate\Http\Request;


interface ProductInterface
{
    public function tumurunleriresimlerlebirliktegetir();
    public function urunekle(testicin $request);
    public function urunsil($productId);
    public function urunduzenleme($productId);
}
