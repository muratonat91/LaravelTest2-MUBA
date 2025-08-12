<?php

namespace App\Library\Repository\Interface;

use Illuminate\Http\Request;
use App\Http\Requests\testicin;
use PHPUnit\Event\Code\Test;

interface CategoryInterface
{
    public function newCategory(Testicin $request);
    public function getCategories();
    public function getCategoryById($id);
    public function updateCategory(Request $request, $id);
    public function deletecategory($id);
}
