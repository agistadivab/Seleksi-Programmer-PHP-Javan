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
    $input = $request->all();

    $validator = Validator::make($input, [
        'code' => 'required|unique:villages,code',
        'district_code' => 'required',
        'name' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status_code' => 400,
            'message' => 'Validation Error',
            'errors' => $validator->errors()
        ], 400);
    }

    $village = Village::create($input);

    return response()->json([
        'status_code' => 201,
        'message' => 'Village created successfully',
        'data' => $village
    ], 201);
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

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|max:255'
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

        $village->update($input);

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
