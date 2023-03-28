<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Amenity;
use Validator;

class AmenityController extends Controller
{
    public function amenityUpload(Request $request)
    {
        // $rules = array(
        //     'name' => 'required|max:255',
        //     'icon' => 'file|mimes:jpg,png|min:200',
        // );
        // $validator = Validator::make($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 400);
        // }
        $fileNames = [];
        foreach ($request->file('icon') as $image) {

            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $fileNames[] = $imageName;
        }
        $images = json_encode($fileNames);
        $amenity = new Amenity();
        $amenity->name = $request->name;
        $amenity->icon = $images;
        $amenity->user_id = $request->user_id;
        $amenity->save();

        if ($amenity) {
            return response()->json([
                'msg' => "Done", 'status' => "200",
                'name' => $amenity->name,
                'icon' => $amenity->icon
            ]);
        } else {
            return ["result" => "error"];
        }
    }
}
