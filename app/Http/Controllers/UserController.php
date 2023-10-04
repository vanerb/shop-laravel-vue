<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create($request->post());

        return response()->json([
            'user'=>$user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->fill($request->post())->save();
       
        return response()->json([
            'user'=>$user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'mensaje'=>'blog eliminado'
        ]);
    }
}
