<?php

namespace App\Http\Controllers;

use App\Http\Requests\testicin;
use App\Library\Repository\Interface\ProductInterface;
use App\Library\Service\Interface\ProductImageInterfaceService;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\Updateicin;
use App\Library\Repository\Interface\CategoryInterface;
use Flasher\Laravel\Http\Request as HttpRequest;

class ProductController extends Controller
{
    //
    public function __construct(
        private readonly ProductInterface $productRepository,
        private readonly ProductImageInterfaceService $productImageService,
        private readonly CategoryInterface $categoryRepository
    ) {}


    public function index()
    {
        $products = $this->productRepository->tumurunleriresimlerlebirliktegetir();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        // kategori için sonradan yazıldı 
        $categories = $this->categoryRepository->getCategories();
        // compact'tan değerler gönderildi
        return view('products.create', compact('categories'));
    }

    public function store(testicin $request)
    {
        // dd($request);  getCategoryById
        try {

            $product = $this->productRepository->urunekle($request);

            flash()->success('Your changes have been saved!');

            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the product: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $product = $this->productRepository->urunsil($id);
            flash()->success('Ürün başarıyla silindi!');
            return redirect()->route('products.index');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred while deleting the product: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $product = $this->productRepository->urunduzenleme($id);
            $categories = $this->categoryRepository->getCategories();
            return view('products.edit', compact('product', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while editing the product: ' . $e->getMessage());
        }
    }


    public function tekresimsil($imageId)
    {
        try {
            $this->productImageService->tekresimsil($imageId);
            flash()->success('Resim başarıyla silindi!');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the image: ' . $e->getMessage());
        }
    }

    public function tekresimguncelle(Updateicin $request, $productId, $imageId)
    {
        // dd($request);
        try {
            // dd($request);
            $this->productImageService->tekresimguncelle($request->file('image'), $productId, $imageId);
            flash()->success('Resim başarıyla güncellendi!');
            return redirect()->back();
        } catch (\Exception $e) {
            flash()->error('Resim güncellenirken bir hata oluştu!');
            return redirect()->back()->with('error', 'An error occurred while updating the image: ' . $e->getMessage());
        }
    }

    public function editsayfasindaresimekleme(Updateicin $request, $productId)
    {
        try {

            $this->productImageService->editsayfasindaresimekleme($request->file('images'), $productId);
            flash()->success('Resim başarıyla eklendi!');
            return redirect()->back();
        } catch (\Exception $e) {
            flash()->error('Resim eklenirken bir hata oluştu!');
            return redirect()->back()->with('error', 'An error occurred while adding the image: '
                . $e->getMessage());
        }
    }
}
