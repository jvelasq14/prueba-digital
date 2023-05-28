<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contactos;
use Illuminate\Support\Facades\DB;
use DateTime;

class ContactosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    private function edad($fecha_nacimiento){
        $nacimiento = new DateTime($fecha_nacimiento);
        $ahora = new DateTime(date("Y-m-d"));
        $diferencia = $ahora->diff($nacimiento);
        return $diferencia->format("%y");
    }

    public function index()
    {
        $a = array();
        $contactos = DB::table('contactos')->where('estado', 1)->get();
        foreach($contactos as $index){
            
            array_push(
                $a,
                array(
                    "nombre_completo" => $index->nombre . " " . $index->apellidos,
                    "telefono"=> $index->telefono,
                    "direccion"=>$index->direccion,
                    "fecha_nacimiento"=> strval($index->fecha_nacimiento),
                    "edad" => $this->edad($index->fecha_nacimiento)
                )
            );   
        }
        return $a;
    }

    
    public function store(Request $request)
    {
        $contactos = new Contactos();
        $contactos->cedula = $request->cedula;
        $contactos->nombre = $request->nombre;
        $contactos->apellidos = $request->apellidos;
        $contactos->telefono = $request->telefono;
        $contactos->direccion = $request->direccion;
        $contactos->fecha_nacimiento = $request->fecha_nacimiento;
        $contactos->estado = $request->estado;
        $contactos->save();

        return $contactos;
    }

    public function show($id)
    {
        $contactos = Contactos::findOrFail($id);
        return $contactos;
    }

    public function update(Request $request,$id)
    {
        
        $contactos = Contactos::findOrFail($id);
        $contactos->cedula = $request->cedula;
        $contactos->nombre = $request->nombre;
        $contactos->apellidos = $request->apellidos;
        $contactos->telefono = $request->telefono;
        $contactos->direccion = $request->direccion;
        $contactos->fecha_nacimiento = $request->fecha_nacimiento;
        $contactos->save();

        return $contactos;
    }

    public function destroy($id, Request $request)
    {
        $contactos = Contactos::findOrFail($id);

        $contactos->estado = $request->estado;

        $contactos->save();

        return $contactos;

    }

}
