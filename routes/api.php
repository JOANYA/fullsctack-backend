<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\DashboardController;

// Rutas API REST para Categorías y Productos
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);

// Ruta para el Dashboard inicial
Route::get('dashboard', [DashboardController::class, 'index']);