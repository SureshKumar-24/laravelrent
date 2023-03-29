<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use App\Models\User;
use Validator;

class ImageController extends Controller
{
    public function imageUpload(Request $request)
    {
        // $user = JWTAuth::parseToken($request->token)->authenticate();
        $user = auth()->user()->id;
        $fileNames = [];
        foreach($request->file('file_name') as $image) {

            $imageName = $image->getClientOriginalName();
            $image->move(public_path('propertyimage'), $imageName);
            $fileNames[] = $imageName;
        }
        $images = json_encode($fileNames);
        $image = new Image();
        $image->caption = $request->caption;
        $image->file_name = $images;
        $image->user_id = $user;
        $image->save();
        if ($image) {
            return response()->json([
                'msg' => "Done", 'status' => "200",
                'caption' => $image->caption,
                'file_name' => $image->file_name,
                'user_id' => $image->user_id,

            ]);
        } else {
            return ["result" => "error"];
        }
    }
    public function getImageUpload()
    {
        $images = User::with('images')->find(1);
        // $images= User::find(2)->images;
        return $images;
    }
}
