<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function alta(Request $request)
    {
        if($request->post("nombre") && $request->post("apellido") && $request->post("telefono") )
        {
            $persona = new Persona();
            $persona->nombre = $request->nombre;
            $persona->apellido = $request->apellido;
            $persona->telefono = $request->telefono;
            $persona->save();
            return $persona;
        }
        return response() -> json([],400);
    }

    public function baja (Request $request, $id){
        $persona = Persona::findOrFail($id);
        $persona -> delete();

        return [ "response" => "La persona con el ID $id ha sido dado de baja"];
    }

}
