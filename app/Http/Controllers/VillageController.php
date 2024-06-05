<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VillageController extends Controller
{

    public function showAll() 
    {
        $villages = Village::all();
        return response()->json(
            [
                'status_code' => 200,
                'message' => 'Success',
                'data' => $villages
            ], 200
        );
    }

    public function showSpecific($id) 
    {
        $village = Village::find($id);

        if (is_null($village)) {
            return response()->json(
                [
                    'status_code' => 404,
                    'message' => 'Village not found.'
                ], 404
            );
        }

        return response()->json(
            [
                'status_code' => 200,
                'message' => 'Success',
                'data' => $village
            ], 200
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:indonesia_villages,code',
            'district_code' => 'required|exists:indonesia_districts,code',
            'name' => 'required|string|max:255',
            'meta' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $village = Village::create([
            'code' => $request->input('code'),
            'district_code' => $request->input('district_code'),
            'name' => $request->input('name'),
            'meta' => $request->input('meta', [
                'lat' => 'NULL',
                'long' => 'NULL',
                'pos' => 'NULL'
            ])
        ]);

        return response()->json(['data' => $village], 201);
    }


    public function update(Request $request, $id) 
{
    $village = Village::find($id);

    if (is_null($village)) {
        return response()->json(
            [
                'status_code' => 404,
                'message' => 'Village not found.'
            ], 404
        );
    }

    $validator = Validator::make($request->all(), [
        'code' => 'sometimes|required|unique:indonesia_villages,code,' . $id,
        'district_code' => 'sometimes|required|exists:indonesia_districts,code',
        'name' => 'sometimes|required|string|max:255',
        'meta' => 'nullable|array'
    ]);

    if ($validator->fails()) {
        return response()->json(
            [
                'status_code' => 400,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 400
        );
    }

    $village->fill($request->all());
    $village->save();

    return response()->json(
        [
            'status_code' => 200,
            'message' => 'Village updated successfully',
            'data' => $village
        ], 200
    );
}


public function destroy($id) 
{
    $village = Village::find($id);

    if (is_null($village)) {
        return response()->json(
            [
                'status_code' => 404,
                'message' => 'Village not found.'
            ], 404
        );
    }

    $village->delete();

    return response()->json(
        [
            'status_code' => 200,
            'message' => 'Village deleted successfully'
        ], 200
    );
}

}
