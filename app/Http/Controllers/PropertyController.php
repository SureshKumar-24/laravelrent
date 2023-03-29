<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Validator;

class PropertyController extends Controller
{
    //
    public function Property(Request $request)
    {
        $rules = array(
            'name' => 'required|string',
            'property_type' => 'required|integer|max:255',
            'description' => 'required|string|max:255',
            'tenancy_status' =>  'required|integer|max:255',
            'street' =>  'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'longitude' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'area' => 'required|integer',
            'funishing_status' => 'required|integer|max:255',
            'funishing_details' => 'required|string|max:255',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        };
        $user = auth()->user()->id;
        $property = new Property();
        $property->user_id = $user;
        $property->name = $request->name;
        $property->property_type = $request->property_type;
        $property->description = $request->description;
        $property->tenancy_status = $request->tenancy_status;
        $property->street = $request->street;
        $property->city = $request->city;
        $property->postal_code = $request->postal_code;
        $property->state = $request->state;
        $property->country = $request->country;
        $property->longitude = $request->longitude;
        $property->latitude = $request->latitude;
        $property->area = $request->area;
        $property->funishing_status = $request->funishing_status;
        $property->funishing_details = $request->funishing_details;
        $property->save();
        if ($property) {
            return response()->json([
                'msg' => "Done", 'status' => "200",
                'user_id' => $property->user_id,
                'name' => $property->name,
                'property_type' => $property->property_type,
                'description' => $property->description,
                'tenancy_status' =>  $property->tenancy_status,
                'street' =>  $property->street,
                'city' => $property->city,
                'postal_code' => $property->postal_code,
                'state' => $property->state,
                'country' => $property->country,
                'longitude' => $property->longitude,
                'latitude' => $request->latitude,
                'area' => $property->area,
                'funishing_status' => $property->funishing_status,
                'funishing_details' => $property->funishing_details,
            ]);
        } else {
            return ["result" => "error"];
        }
    }
}
