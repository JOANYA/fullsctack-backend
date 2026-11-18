<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Traits\ApiResponse;

class DashboardController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $lowStock = Product::with('category')->where('stock', '<=', 5)->get();

        return $this->successResponse([
            'total_products'     => Product::count(),
            'total_categories'   => Category::count(),
            'low_stock_count'    => $lowStock->count(),
            'low_stock_products' => $lowStock
        ], 'Datos del dashboard obtenidos correctamente');
    }
}