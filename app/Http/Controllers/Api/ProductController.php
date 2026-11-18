<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Traits\ApiResponse;

class ProductController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Get(
     *      path="/api/products",
     *      tags={"Productos"},
     *      summary="Obtener lista de productos",
     *      @OA\Response(response=200, description="Listado obtenido correctamente")
     * )
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return $this->successResponse($products, 'Listado de productos obtenido correctamente');
    }

    /**
     * @OA\Post(
     *      path="/api/products",
     *      tags={"Productos"},
     *      summary="Crear un nuevo producto",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name","price","stock","category_id"},
     *              @OA\Property(property="name", type="string", example="Camiseta Overskull"),
     *              @OA\Property(property="description", type="string", example="Camiseta negra edición limitada"),
     *              @OA\Property(property="price", type="number", example=89.90),
     *              @OA\Property(property="stock", type="integer", example=50),
     *              @OA\Property(property="category_id", type="integer", example=1)
     *          )
     *      ),
     *      @OA\Response(response=201, description="Producto creado correctamente")
     * )
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        return $this->successResponse($product->load('category'), 'Producto creado correctamente', 201);
    }

    public function show(Product $product)
    {
        return $this->successResponse($product->load('category'), 'Producto obtenido correctamente');
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return $this->successResponse($product->load('category'), 'Producto actualizado correctamente');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return $this->successResponse(null, 'Producto eliminado correctamente');
    }
}