<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property_room;
use Validator;
use Mail;
use JWTAuth;

class PropertyRoomController extends Controller
{
    public function roomcontroller(Request $request)
    {
        $fileNames = [];
        foreach ($request->file('url') as $image) {

            $imageName = $image->getClientOriginalName();
            $image->move(public_path('roomimage'), $imageName);
            $fileNames[] = $imageName;
        }
        $images = json_encode($fileNames);
        $room = new Property_room();
        $room->name = $request->name;
        $room->url = $images;
        $room->caption = $request->caption;
        $room->room_type = $request->room_type;
        $room->property_id = "1";
        $room->save();
        if ($room) {
            return response()->json([
                'msg' => "Done", 'status' => "200",
                'name' => $room->name,
                'url' => $room->url,
                'caption' => $room->caption,
                'room_type' => $room->room_type,
                'property_id' => $room->property_id,
            ]);
        } else {
            return ["result" => "error"];
        }
    }
}
