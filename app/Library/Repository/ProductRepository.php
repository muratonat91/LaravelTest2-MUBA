<?php

namespace App\Library\Repository;

use App\Http\Requests\testicin;
use App\Library\Repository\Interface\CategoryInterface;
use App\Library\Repository\Interface\ProductInterface;
use App\Library\Service\Interface\ProductImageInterfaceService;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductInterface
{
    // private $product_id;

    public function __construct(
        private readonly ProductImageInterfaceService $productImageService,
        private readonly CategoryInterface $categoryRepository
    ) {}

    public function tumurunleriresimlerlebirliktegetir()
    {
        //category sonradan eklendi -  test amacıyla
        $tumurunler = Product::with(['images', 'category'])->paginate(3);
        return $tumurunler;
    }

    public function urunekle(testicin $request)
    {
        return DB::transaction(function () use ($request) {

            // kategori eklemek için 
            // dd($request);
            $product = Product::create($request->only(['name', 'description', 'price', 'category_id']));

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $this->productImageService->uploadImage($image, $product->id);
                }
            }
            return  $product;
        });
    }

    public function urunsil($productId)
    {
        return DB::transaction(function () use ($productId) {
            $product = Product::findOrFail($productId);
            $deletedimages = $this->productImageService->deleteImage($productId);
            $product->delete();


            return $product;
        });
    }
    public function urunduzenleme($productId)
    {
        $urun = Product::with(['images', 'category'])->findOrFail($productId);

        return $urun;
    }
}
