<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRecord
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        if(!(Auth::guard("sanctum")->check())) {
            $response = [
                'success' => false,
                'message' => "You arent logged (not check)",
                'data' => null
            ];
            return response()->json($response, 200);
        }
        return $next($request);
    }
}
