<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //Recoge user y password y logeará al usuarui devolviendo un token
    public function login(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        //Una vez que el login se ga completado con attemp,
        // el usuario (instacioado de user) queda almacenado en la clase AUTH
        // al tener
        if(Auth::guard("sanctum")->check()) {
            $response = [
                'success' => true,
                'message' => "You are logged",
                'data' => "Your name is: " . $data['name']
            ];
            return response()->json($response, 200);
        }elseif (Auth::attempt($data)){
            $obtained = Auth::user()->createToken("token");
            $response = [
                'success' => true,
                'message' => "You have logged in successfully",
                'data' => $obtained
            ];
            return response()->json($response, 200);
        }
        $response = [
            'success' => false,
            'message' => "Name or password does not exist",
            'data' => null
        ];
        return response()->json($response, 401);
    }



    //solo se puede llamar si el usuario está logggeado
    //devolvera yb mensasaje con el nombre del usuario
    /*public function whoAmI(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        $name = $data['name'];
        $response = [
            'success' => true,
            'message' => "You are logged, welcome",
            'data' => "Your name is " . $name
        ];
        if(Auth::attempt($data)) {
            $obtained = auth()->user()->name;
            $response = [
                'success' => true,
                'message' => "you are already logged in",
                'data' => $obtained
            ];
            return response()->json($response, 200);
        }
        /*if(Auth::attempt($data)){
            return Redirect::to('auth/welcome');
        }
        /*if(Auth::attempt($data)) {
            return "asd";
        }
        return response()->json($response, 200);

    }*/
}

