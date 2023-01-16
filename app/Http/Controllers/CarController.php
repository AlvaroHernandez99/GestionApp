<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function getAll(Request $request){
        $respuesta = Car::all();
        $response = [
            'success' => true,
            'message' => "Coches obtenidos correctamente",
            'data' => $respuesta
        ];
        return response()->json($response);
    }

    public function getId(Request $request, $id){
        try {
            $respuesta = Car::findOrFail($id);
            $response = [
                'success' => true,
                'message' => "Coche con id: $id obtenido correctamente",
                'data' => $respuesta
            ];
            return response()->json($response);
        } catch (ModelNotFoundException $ex) {
            return $a = [
                'success' => false,
                'message' => "Error, el Id introducido no existe ne la db"
            ];
            return response()->json($a);
        }

    }

    public function create(Request $request){
        $matricula = $request->input('matricula');
        $marca = $request->input('marca');
        $modelo = $request->input('modelo');

        $datos = $request->validate([
            'matricula' => 'required|string:unique',
            'marca' => 'required|string',
            'modelo' => 'nullable|string'

        ]);

        //query building
        DB::table('cars')->insert($datos);
        $response = [
            'success' => true,
            'message' => "Coche creado correctamente",
            'data' => $datos
        ];
        return response()->json($response);
    }

    public function delete(Request $request, $id){
        try {
            $respuesta = Car::findOrFail($id);
            DB::table('cars')->where('id', $id)->delete();
            $response = [
                'success' => true,
                'message' => "Coche con id: $id borrado correctamente",
                'data' => $respuesta
            ];
            return response()->json($response);
        } catch (ModelNotFoundException $ex) {
            return $a = [
                'success' => false,
                'message' => "Error, el Id introducido no existe ne la db"
            ];
            return response()->json($a);
        }

    }

    public function modify(Request $request, $id){
        try {
            Car::findOrFail($id);
            $matricula = $request->input('matricula');
            $marca = $request->input('marca');
            $modelo = $request->input('modelo');

            $datos = $request->validate([
                'matricula' => 'required|string:unique',
                'marca' => 'required|string',
                'modelo' => 'nullable|string'
            ]);
            //query building
            DB::table('cars')->where('id', $id)->update($datos);
            $response = [
                'success' => true,
                'message' => "Coche con id: $id modificado correctamente",
                'data' => $datos
            ];
            return response()->json($response);
        } catch (ModelNotFoundException $ex) {
            return $a = [
                'success' => false,
                'message' => "Error, el Id introducido no existe ne la db"
            ];
            return response()->json($a);
        }
    }

    public function employee(Request $request, $id) {
        $companycar = Car::findOrFail($id);
        return response()->json($companycar->employee);
    }

}
