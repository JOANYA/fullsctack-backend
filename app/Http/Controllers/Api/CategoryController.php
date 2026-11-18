<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class CategoryController extends Controller
{
    use ApiResponse;

    // Listar todas las categorías con el conteo de productos
    public function index()
    {
        $categories = Category::withCount('products')->get();
        return $this->successResponse($categories, 'Listado de categorías obtenido correctamente');
    }

    // Guardar una nueva categoría
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string'
        ]);

        $category = Category::create($validated);
        return $this->successResponse($category, 'Categoría agregada correctamente', 201);
    }

    // Actualizar una categoría existente
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string'
        ]);

        $category->update($validated);
        return $this->successResponse($category, 'Categoría editada correctamente');
    }

    // Eliminar categoría solo si NO tiene productos asociados
    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede eliminar la categoría porque tiene productos asignados.'
            ], 422);
        }

        $category->delete();
        return $this->successResponse(null, 'Categoría eliminada correctamente');
    }
}