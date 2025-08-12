<?php


namespace App\Library\Service;

use App\Http\Requests\testicin;
use App\Library\Service\Interface\ProductImageInterfaceService;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Updateicin;




class ProductImageService implements ProductImageInterfaceService
{

    public function uploadImage(UploadedFile $imageFile, $productId)
    {


        $fileName = Carbon::now()->format("dmy_His") . "_" . $imageFile->getClientOriginalName();
        $filepath = public_path('assets/images/products/');


        if (!file_exists($filepath)) {
            mkdir($filepath, 0755, true); // klasörü oluştur
        }


        $imageFile->move($filepath, $fileName);

        return ProductImage::create([
            'product_id' => $productId,
            'image_path' => 'assets/images/products/' . $fileName
        ]);
    }

    public function deleteImage($imageId)
    {
        $silinecekResimler = ProductImage::where('product_id', $imageId)->get();

        // dd($silinecekResimler);
        foreach ($silinecekResimler as $resim) {
            $imagePath = public_path($resim->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Dosyayı sil
            }
            $resim->delete(); // Veritabanından resmi sil
        }
    }
    public function getImagesbyId($productId)
    {

        $images = ProductImage::where('product_id', $productId)->get();
        if ($images->isEmpty()) {
            return null;
        }
        return $images;
    }

    public function tekresimsil($imageId)
    {

        $resim = ProductImage::findOrFail($imageId);
        $imagePath = public_path($resim->image_path);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Dosyayı sil
        }
        $resim->delete();
    }

    public function tekresimguncelle(UploadedFile $imageFile, $productId, $imageId)
    {
        DB::transaction(function () use ($imageFile, $productId, $imageId) {

            //  dd($imageFile);
            $resim = ProductImage::findOrFail($imageId);
            // dd($resim);
            $imagePath = public_path($resim->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Eski dosyayı sil
            }

            $resim->delete();

            // burada $this->uploadImage() fonksiyonunu kullanarak yeni resmi yükle
            // ve resmi veritabanına kaydet
            // $uploadedImage = $this->uploadImage($imageFile, $productId);
            $fileName = Carbon::now()->format("dmy_His") . "_" . $imageFile->getClientOriginalName();
            $filepath = public_path('assets/images/products/');
            if (!file_exists($filepath)) {
                mkdir($filepath, 0755, true); // klasörü oluştur
            }
            $imageFile->move($filepath, $fileName);

            $uploadedImage = ProductImage::create([
                'product_id' => $productId,
                'image_path' => 'assets/images/products/' . $fileName
            ]);
            // eski resmi veritabanından sil


            return $uploadedImage;
        });
    }

    public function  editsayfasindaresimekleme(array $imageFiles, $productId)
    {
        foreach ($imageFiles as $imageFile) {
            $fileName = Carbon::now()->format("dmy_His") . "_" . $imageFile->getClientOriginalName();
            $filepath = public_path('assets/images/products/');

            if (!file_exists($filepath)) {
                mkdir($filepath, 0755, true);
            }

            $imageFile->move($filepath, $fileName);

            ProductImage::create([
                'product_id' => $productId,
                'image_path' => 'assets/images/products/' . $fileName
            ]);
        }
    }
}
