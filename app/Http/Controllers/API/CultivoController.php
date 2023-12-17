<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cultivo;



class CultivoController extends Controller
{
    public function index()
    {
        // Obtener los cultivos del usuario autenticado
        $cultivos = auth()->user()->cultivos;
        return response()->json(['cultivos' => $cultivos], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $cultivo = new Cultivo([
            'nombre' => $request->input('nombre'),
        ]);

        auth()->user()->cultivos()->save($cultivo);

        return response()->json(['cultivo' => $cultivo], 201);
    }

    public function update(Request $request, Cultivo $cultivo)
    {
        $this->authorize('update', $cultivo);

        $request->validate([
            'nombre' => 'required|string',
        ]);

        $cultivo->update([
            'nombre' => $request->input('nombre'),
        ]);

        return response()->json(['cultivo' => $cultivo], 200);
    }


    public function destroy(Cultivo $cultivo)
    {
        $this->authorize('delete', $cultivo);
    
        $cultivo->delete();
    
        return response()->json(null, 204);
}
 }