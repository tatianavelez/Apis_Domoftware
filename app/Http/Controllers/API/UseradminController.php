<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UseradminController extends Controller
{
     //Ver usuarios
     public function Usuarios()
     {
         $users = User::all();
     
         return response()->json($users);
     }
 
 
     //Traer usuarios por ids
     public function Usuarioid($id)
     {
         try {
             $usuario = User::findOrFail($id); 
     
             return response()->json(['message' => 'Usuario encontrado correctamente', 'usuario' => $usuario], 200);
         } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
 
             return response()->json(['error' => 'Usuario no encontrado', 'message' => $e->getMessage()], 404);
         } 
     }

     
}
