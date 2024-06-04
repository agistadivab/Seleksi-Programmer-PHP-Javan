<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VillageController extends Controller
{

    public function showAll() 
    {
        $villages = Village::get();
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
            return $this->sendError('Village not found.');
        }

        return response()->json(
            [
                'status_code' => 200,
                'message' => 'Success',
                'data' => $village
            ]
        );
    }

    public function store(Request $request) 
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Name is required.', $validator);
        }

        $village = Village::create($input);

        return response()->json(
            [
                'status_code' => 200,
                'message' => 'Success',
                'data' => $village
            ]
        );
    }

    public function update(Request $request, Village $village, $id) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Name is required.', $validator);
        }
        $village = Village::find($id);
        $village->update([
            'name' => $request->name
        ]);

        return response()->json(
            [
                'status_code' => 200,
                'message' => 'Success Update',
                'data' => $village
            ]
        );
    }

    public function destroy(Village $village, $id) {
        $village = Village::find($id);
        $village->destroy($id);

        return response()->json(
            [
                'status_code' => 200,
                'message' => 'Success Delete',
            ]
        );
    }
}
