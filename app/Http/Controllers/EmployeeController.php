<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function getAll(Request $request){
        $respuesta = Employee::all();
        $response = [
            'success' => true,
            'message' => "Trabajadores obtenidos correctamente",
            'data' => $respuesta
        ];
        return response()->json($response);
    }

    public function getId(Request $request, $id){
        try {
            $respuesta = Employee::findOrFail($id);
            $response = [
                'success' => true,
                'message' => "Trabajador con id: $id obtenido correctamente",
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
        $name = $request->input('name');
        $phone = $request->input('phone');
        $age = $request->input('age');
        $password = $request->input('password');
        $email = $request->input('email');
        $gender = $request->input('gender');

        $datos = $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'age' => 'nullable|integer',
            'password' => 'required|string',
            'email' => 'required|string|unique:employees',
            'gender' => 'required|string'
        ]);

        //query building
        DB::table('employees')->insert($datos);
        $response = [
            'success' => true,
            'message' => "Trabajador creado correctamente",
            'data' => $datos
        ];
        return response()->json($response);
    }

    public function delete(Request $request, $id){
        try {
            $respuesta = Employee::findOrFail($id);
            DB::table('employees')->where('id', $id)->delete();
            $response = [
                'success' => true,
                'message' => "Trabajador con id: $id borrado correctamente",
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
            Employee::findOrFail($id);
            $name = $request->input('name');
            $phone = $request->input('phone');
            $age = $request->input('age');
            $password = $request->input('password');
            $email = $request->input('email');
            $gender = $request->input('gender');

            $datos = $request->validate([
                'name' => 'required|string',
                'phone' => 'nullable|string',
                'age' => 'nullable|integer',
                'password' => 'required|string',
                'email' => 'required|string|unique:employees',
                'gender' => 'required|string'
            ]);
            //query building
            DB::table('employees')->where('id', $id)->update($datos);
            $response = [
                'success' => true,
                'message' => "Trabajador con id: $id modificado correctamente",
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
}
