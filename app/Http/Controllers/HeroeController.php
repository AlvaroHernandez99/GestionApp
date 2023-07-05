<?php

namespace App\Http\Controllers;

use App\Models\Heroe;
use Illuminate\Http\Request;
use Throwable;

class HeroeController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $heroe = Heroe::all();
        } catch (Throwable $e) {
            return response('Any heroe found');
        }

        $response = [];

        if (isset($heroe[0])) {
            $response = [
                'success' => true,
                'message' => "Heroe fetched successfully",
                'data' => $heroe
            ];

            return response()->json($response);
        } else {

            $response = [
                'success' => false,
                'message' => "No heroe found",
                'data' => null
            ];
            return response()->json($response);
        }
    }
    public function getById(Request $request, $id)
    {
        $heroe = Heroe::find($id);
        if ($heroe != null) {
            $response = [
                'success' => true,
                'message' => 'Heroe found successfully',
                'data' => $heroe
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Heroe not found',
                'data' => null
            ];
        }
        return response()->json($response);
    }
    public function create(Request $request)
    {
        $id = null;
        try {
            $id = Heroe::insertGetId($request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'hasCape' => 'nullable|boolean',
            ]));
        } catch (Throwable $e) {
            report($e);

            $response = [
                'success' => false,
                'message' => 'Heroe has not been created, some data may be missing',
                'data' => null
            ];
            return response()->json($response, 422);
        }
        if (is_numeric($id)) {
            $response = [
                'success' => true,
                'message' => 'Heroe created successfully',
                'data' => Heroe::findOrFail($id)
            ];
            return response()->json($response);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $deleteHeroe= Heroe::find($id);

            $heroe = $deleteHeroe;
            $heroe->delete();
            $response = [
                'success' => true,
                'message' => 'Heroe was deleted',
                'data' => $deleteHeroe
            ];
            return response()->json($response);

        } catch (Throwable $e) {
            report($e);
            $response = [
                'success' => false,
                'message' => 'Heroe has not been deleted because it wasnt not found',
                'data' => null
            ];
            return response()->json($response);
        }
    }

    public function update(Request $request, $id)
    {
        if ($heroe = Heroe::find($id)) {

            try {
                $heroe->update($request->validate([
                    'name' => 'required|string',
                    'description' => 'required|string',
                    'hasCape' => 'nullable|boolean',
                ]));
            } catch (Throwable $e) {
                report($e);

                $response = [
                    'success' => false,
                    'message' => 'Heroe has not been updated',
                    'data' => null
                ];
                return response()->json($response, 422);
            }
            $heroe->save();
            $response = [
                'success' => true,
                'message' => 'Heroe updated successfully',
                'data' => $heroe
            ];
            return response()->json($response);
        } else {
            $response = [
                'success' => false,
                'message' => 'Heroe not found',
                'data' => null
            ];
            return response()->json($response);
        }
    }


    public function search(Request $request, $inputSearch){
        $name = $inputSearch;
        $nameFound = Heroe::where('name', 'LIKE', $name.'%')->get();
        return response()->json($nameFound);
    }


}
