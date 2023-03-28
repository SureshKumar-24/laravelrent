<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use Validator;

class ImageController extends Controller
{
    public function imageUpload(Request $request)
    {
        $fileNames = [];
        foreach ($request->file('file_name') as $image) {

            $imageName = $image->getClientOriginalName();
            $image->move(public_path('propertyimage'), $imageName);
            $fileNames[] = $imageName;
        }
        $images = json_encode($fileNames);
        $image = new Image();
        $image->caption = $request->caption;
        $image->file_name = $images;
        $image->user_id = $request->user_id;
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
}
