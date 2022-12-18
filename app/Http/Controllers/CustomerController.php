<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //return response()->json('Devuelvo todos los clientes');
    }

    public function getId(Request $request, $id){
        $respuesta = Customer::findOrFail($id);
        $response = [
            'success' => true,
            'message' => "Cliente obtenido correctamente",
            'data' => $respuesta
        ];
        return response()->json($response);
    }

    public function create(Request $request){
        $name = $request->input('name');
        $phone = $request->input('phone');
        $age = $request->input('age');
        $password = $request->input('password');
        $email = $request->input('email');
        $gender = $request->input('gender');

        $datos = $request->validate([
            //obligatorio y tiene que ser el tipo de pariable marcado
            'name' => 'string',
            'phone' => 'string', //como lo pongo nullable¿?¿¿
            'age' => 'integer', //como lo pongo nullable¿?¿¿
            'password' => "string",
            'email' => 'required|string|unique:customers',
            'gender' => 'string'
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
        $respuesta = Customer::findOrFail($id);
        DB::table('customers')->where('id', $id)->delete();
        $response = [
            'success' => true,
            'message' => "Cliente borrado correctamente",
            'data' => $respuesta
        ];
        return response()->json($response);
    }

    public function modify(Request $request){
        $name = $request->input('name');
        $phone = $request->input('phone');
        $age = $request->input('age');
        $password = $request->input('password');
        $email = $request->input('email');
        $gender = $request->input('gender');

        $datos = $request->validate([
            //obligatorio y tiene que ser el tipo de pariable marcado
            'name' => 'string',
            'phone' => 'string',
            'age' => 'integer',
            'password' => "string",
            'email' => 'required|string|unique:customers',
            'gender' => 'string'
        ]);
        //query building
        DB::table('customers')->update($datos);
    }
}
