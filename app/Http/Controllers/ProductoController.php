<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductosCollection;
use App\Http\Resources\ProductosResource;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = Producto::with('categoria')->get();

        return new ProductosCollection($productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|numeric',
            'cantidad' => 'required|numeric',
            'precio' => 'required|numeric'
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no puede exceder 255 caracteres.',

            'categoria_id.required' => 'El campo categoría es obligatorio.',
            'categoria_id.numeric' => 'El campo categoría debe ser un número.',

            'cantidad.required' => 'El campo cantidad es obligatorio.',
            'cantidad.numeric' => 'El campo cantidad debe ser un número.',

            'precio.required' => 'El campo precio es obligatorio.',
            'precio.numeric' => 'El campo precio debe ser un número.'
        ]);

        $producto = Producto::create($validate);
        $producto->load('categoria');

        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
        return new ProductosResource($producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //


        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|numeric',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id', // Validar que la categoría exista
        ]);

        $producto->update($validatedData);

        return response()->json($producto, 200); // Devuelve el producto ac
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
        $producto->delete();

        return response()->json(['message' => 'Producto eliminado correctamente.'], 200);
    }
}
