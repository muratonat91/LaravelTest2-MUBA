<?php

namespace App\Providers;

use App\Library\Repository\CategoryRepository;
use App\Library\Repository\Interface\CategoryInterface;
use Illuminate\Support\ServiceProvider;

use App\Library\Service\ProductImageService;
use App\Library\Repository\ProductRepository;
use App\Library\Repository\Interface\ProductInterface;
use App\Library\Service\Interface\ProductImageInterfaceService;


class testbind extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(ProductImageInterfaceService::class, ProductImageService::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
