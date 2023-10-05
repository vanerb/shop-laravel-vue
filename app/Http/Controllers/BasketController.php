<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Http\Request;

class BasketController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $perPage = Basket::count(); // Número de productos por página
        $page = request('page', 1); // Obtener el número de página de la solicitud

        $user_id = $request->input('user_id');

        
        $basket = Basket::skip(($page - 1) * $perPage)->take($perPage)->where('user_id', $user_id)->get();

        return response()->json($basket);
    }

   
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $basket = Basket::create($request->post());
        return response()->json([
            'basket' => $basket
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Basket $basket)
    {
        return response()->json( $basket);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Basket $basket)
    {
        $basket->fill($request->post())->save();
        return response()->json([
            'basket'=> $basket
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Basket $basket)
    {
        $basket->delete();
        return response()->json([
            'mensaje'=>'producto borrado con exito'
        ]);
    }
}
