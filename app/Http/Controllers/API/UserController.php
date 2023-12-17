<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
 

    public function eliminarCuentapropia(Request $request)
    {
        $usuario = Auth::user();

        try {
            $usuario->delete();

            return response()->json(['message' => 'Cuenta eliminada correctamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la cuenta', 'message' => $e->getMessage()], 500);
        }
    }


}
