<?php

namespace App\Library\Repository;

use App\Http\Requests\testicin;
use App\Library\Repository\Interface\CategoryInterface;
use App\Models\category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryRepository implements CategoryInterface
{
    public function getCategories()
    {
        return category::paginate(6);
    }

    public function newCategory(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $category = category::create($request->only(['category_name', 'is_active']));
            return $category;
        });
    }

    public function getCategoryById($id)
    {
        return category::findorfail($id);
    }

    public function updateCategory(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $category = category::findorfail($id);
            $category->update($request->only(['category_name', 'is_active']));
            return $category;
        });
    }

    public function deletecategory($id)
    {
        return DB::transaction(function () use ($id) {
            $category = category::findorfail($id);
            $category->delete();
            return $category;
        });
    }
}
