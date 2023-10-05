<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = $request->input('user_id');
        $products = Product::where('user_id', $user_id)->get();

        return response()->json($products);
    }

    public function productall()
    {
        $perPage = Product::count(); // Número de productos por página
        $page = request('page', 1); // Obtener el número de página de la solicitud
        $products = Product::skip(($page - 1) * $perPage)->take($perPage)->get();

        return response()->json($products);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create($request->post());
        return response()->json([
            'product' => $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->fill($request->post())->save();
        return response()->json([
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'mensaje' => 'producto borrado con exito'
        ]);
    }
}
