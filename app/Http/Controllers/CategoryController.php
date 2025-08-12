<?php

namespace App\Http\Controllers;

use App\Library\Repository\Interface\CategoryInterface;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    //
    public function __construct(private readonly CategoryInterface $categoryRepository) {}

    public function index()
    {
        $categories = $this->categoryRepository->getCategories();
        return view('category.index', compact('categories'));
    }
    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        try {
            $this->categoryRepository->newCategory($request);
            flash()->success('perfect');
            return redirect()->route('category.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the product: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->getCategoryById($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $categoryid)
    {
        try {
            $this->categoryRepository->updateCategory($request, $categoryid);
            flash()->success('perfect');
            return redirect()->route('category.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the product: '
                . $e->getMessage());
        }
    }

    public function destroy($productid)
    {
        try {
            $this->categoryRepository->deletecategory($productid);
            flash()->success('perfect');
            return redirect()->route('category.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the product: '
                . $e->getMessage());
        }
    }
}
