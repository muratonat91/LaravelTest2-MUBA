<?php

namespace App\Library\Service\Interface;


use App\Http\Requests\testicin;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\updateicin;


interface ProductImageInterfaceService
{

    public function uploadImage(UploadedFile $imageFile, $productId);

    public function deleteImage($imageId);

    public function getImagesbyId($productId);

    public function tekresimsil($imageId);

    public function tekresimguncelle(UploadedFile $imageFile, $productId, $imageId);

    public function  editsayfasindaresimekleme(array $imageFiles, $productId);
}
