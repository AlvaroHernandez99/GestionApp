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
        if(Auth::guard("sanctum")->check()) {
            $response = [
                'success' => true,
                'message' => "You are logged",
                'data' => "Your name is: " . $data['name']
            ];
            return response()->json($response, 200);
        //Una vez que el login se ga completado con attemp,
        // el usuario (instacioado de user) queda almacenado en la clase AUTH
        // al tener
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


    public function dataUser(Request $request){

        $data = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        if(Auth::attempt($data)) {

            $obtained = Auth::user()->createToken("token");
            $response = [
                'success' => true,
                'message' => "You are logged and your data is:",
                'data' => [
                    "Your name is: " . $data['name'],
                    "Your password is: " . $data['password'],

                ],
                'completeData' => $obtained
            ];
            return response()->json($response, 200);
        }
        //$obtained = Auth::user()->createToken("token");

    }

}

