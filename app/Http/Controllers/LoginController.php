<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function __construct()
    { }

    //Recoge user y password y logeará al usuarui devolviendo un token
    public function login(Request $request) {
        if ($request->has('name')){
            $data = $request->validate([
                'name' => 'required|string',
                'password' => 'required|string'
            ]);
            if (Auth::guard('api')->check()) {
                $response = [
                    'success' => true,
                    'message' => "You are logged",
                    'data' => "Your name of sesion is: " . $data['name']
                ];
                return response()->json($response);
            }
        }
        elseif ($request->has('email')){
            $data = $request->validate([
                'email' => 'required|string|email:rfc',
                'password' => 'required|string'
            ]);
            if (Auth::guard('api')->check()) {
                $response = [
                    'success' => true,
                    'message' => "You are logged",
                    'data' => "Your email of sesion is: " . $data['email']
                ];
                return response()->json($response);
            }
        }
        if (Auth::attempt($data)){
            $obtained = Auth::user()->createToken("token");
            $response = [
                'success' => true,
                'message' => "You have logged in successfully",
                'data' => $obtained
            ];
            return response()->json($response);
        }
        $response = [
            'success' => false,
            'message' => "Name or password does not exist",
            'data' => null
        ];
        return response()->json($response, 401);
    }


    public function dataUser(Request $request) {
        $obtained = Auth::user()->createToken("token");
        if ($request ->has('name')){
            $data = $request->validate([
                'name' => 'required|string',
                'password' => 'required|string'
            ]);
            if (Auth::guard('api')->check()) {
                $response = [
                    'success' => true,
                    'message' => "You are logged",
                    'data' => [
                        "nombre" => $data['name'],
                        "troleito " => "Your token is: <PakkieressaberesoGG>",
                        'DataToken' => $obtained
                    ],
                ];
                return response()->json($response);
            }
        }
        if ($request ->has('email')){
            $data = $request->validate([
                'email' => 'required|email:rfc',
                'password' => 'required|string'
            ]);
            if (Auth::guard('api')->check()) {
                $response = [
                    'success' => true,
                    'message' => "You are logged",
                    'data' => [
                        "email" => $data['email'],
                        "troleito " => "Your token is: <PakkieressaberesoGG>",
                        'DataToken' => $obtained
                    ],
                ];
                return response()->json($response);
            }
        }
    }


    public function logOut(Request $request) {
        Auth::guard('api')->user()->tokens()->delete();
        if($request){
            $response = [
                'success' => true,
                'message' => "Log out successfully",
                'data' => null
            ];
            return response()->json($response);
        }
    }


    public function guest(Request $request) {
        $response = [
            'success' => true,
            'message' => "successfully accessed",
            'data' => "guest user"
        ];
        return response()->json($response);
    }

    public function createUser (Request $request) {
        try {
            $id = User::insertGetId($request->validate([
                'email' => 'required|email:rfc|unique:users',
                'name' => 'required|string|unique:users',
                'password' => 'required|string'
            ]));
        } catch (Throwable $e) {
            report($e);
            $response = [
                'success' => false,
                'message' => 'Warning, the information is lost',
                'data' => null
            ];
            return response()->json($response, 422);
        }
        if (is_numeric($id)) {
            $response = [
                'success' => true,
                'message' => 'The user has created successfully',
                'data' => User::findOrFail($id)
            ];
            return response()->json($response);
        }
    }





}





