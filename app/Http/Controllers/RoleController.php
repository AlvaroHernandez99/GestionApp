<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /*public function roles() {
        return $this->belongsTo(Customer::Class);
    }

    public function getRoles(){
        $roles = Customer::find(1)->roles;
    }*/

    public function getAll(Request $request){
        $respuesta = Role::all();
        $response = [
            'success' => true,
            'message' => "Roles obtenidos correctamente",
            'data' => $respuesta
        ];
        return response()->json($response);
    }

    public function getId(Request $request, $id){
        try {
            $respuesta = Role::findOrFail($id);
            $response = [
                'success' => true,
                'message' => "Rol con id: $id obtenido correctamente",
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
        $rol = $request->input('rol');
        $description = $request->input('description');

        $datos = $request->validate([
            'rol' => 'required|string',
            'description' => 'nullable|string'
        ]);

        //query building
        DB::table('roles')->insert($datos);
        $response = [
            'success' => true,
            'message' => "Rol creado correctamente",
            'data' => $datos
        ];
        return response()->json($response);
    }

    public function delete(Request $request, $id){
        try {
            $respuesta = Role::findOrFail($id);
            DB::table('roles')->where('id', $id)->delete();
            $response = [
                'success' => true,
                'message' => "Rol con id: $id borrado correctamente",
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
            Role::findOrFail($id);
            $rol = $request->input('rol');
            $description = $request->input('description');

            $datos = $request->validate([
                'rol' => 'required|string',
                'description' => 'nullable|string'
            ]);
            //query building
            DB::table('roles')->where('id', $id)->update($datos);
            $response = [
                'success' => true,
                'message' => "Rol con id: $id modificado correctamente",
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
