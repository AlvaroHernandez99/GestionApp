<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class CustomerController extends Controller
{
    public function getAll(Request $request){
        $respuesta = Customer::all();
        $response = [
            'success' => true,
            'message' => "Clientes obtenidos correctamente",
            'data' => $respuesta
        ];
        return response()->json($response);
    }

    public function getId(Request $request, $id){
        try {
            $respuesta = Customer::findOrFail($id);
            $response = [
                'success' => true,
                'message' => "Cliente con id: $id obtenido correctamente",
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
            'email' => 'required|string|unique:customers',
            'gender' => 'required|string'
        ]);

        //query building
        DB::table('customers')->insert($datos);
        $response = [
            'success' => true,
            'message' => "Cliente creado correctamente",
            'data' => $datos
        ];
        return response()->json($response);
    }

    public function delete(Request $request, $id){
        try {
            $respuesta = Customer::findOrFail($id);
            DB::table('customers')->where('id', $id)->delete();
            $response = [
                'success' => true,
                'message' => "Cliente con id: $id borrado correctamente",
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
            Customer::findOrFail($id);
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
                'email' => 'required|string|unique:customers',
                'gender' => 'required|string'
            ]);
            //query building
            DB::table('customers')->where('id', $id)->update($datos);
            $response = [
                'success' => true,
                'message' => "Cliente con id: $id modificado correctamente",
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
