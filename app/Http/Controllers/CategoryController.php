<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = Category::count(); // Número de productos por página
        $page = request('page', 1); // Obtener el número de página de la solicitud

        $category = Category::skip(($page - 1) * $perPage)->take($perPage)->get();

        return response()->json( $category);
    }

   
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create($request->post());
        return response()->json([
            'category' => $category
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json( $category);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->fill($request->post())->save();
        return response()->json([
            'category'=> $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'mensaje'=>'producto borrado con exito'
        ]);
    }
}
