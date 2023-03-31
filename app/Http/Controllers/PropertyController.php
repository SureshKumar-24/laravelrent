<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Image;
use App\Models\Property_image;
use App\Models\Property_room;
use App\Models\Property_amenity;
use App\Models\PropertyQuestion;
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

        //******************Property Image**********************************/

        $property_id = $property->id;
        foreach ($request->images as $image) {
            $propertyimage = new Property_image();
            $propertyimage->image_id = $image['id'];
            $propertyimage->property_id = $property_id;
            $propertyimage->save();
        }

        //******************Property Amenity**********************************/

        foreach ($request->amenities as $amenity) {
            $propertyamenity = new Property_amenity();
            $propertyamenity->amenity_id = $amenity['id'];
            $propertyamenity->property_id = $property_id;
            $propertyamenity->save();
        }
        //******************Property Rooms**********************************/
        foreach ($request->rooms as $room) {
            $propertyroom = new Property_room;
            $propertyroom->name = $room['name'];
            $propertyroom->url = $room['url'];
            $propertyroom->caption = $room['caption'];
            $propertyroom->room_type = $room['room_type'];
            $propertyroom->property_id = $property_id;
            $propertyroom->save();
        }
        //******************Property Rooms**********************************/
        foreach ($request->questions as $question) {
            $propertyquestion = new PropertyQuestion;
            $propertyquestion->question_id = $question['question_id'];

            $propertyquestion->property_id = $property_id;
            $propertyquestion->save();
        }

        //******************Property Rooms**********************************/
        $propertydata = Property::with('Images', 'amenities', 'Rooms', 'PropertyQuestion.question_options')->find($property_id);



        if ($property) {
            return response()->json([
                'msg' => "Done", 
                'status' => "Property Created Successfully",
                'Property' => $propertydata,
            ]);
        } else {
            return ["result" => "error"];
        }
    }

    public function getProperty()
    {
        $property = Property::with('Images')->find(2);
        return $property;
    }
    //delete the property_id
    public function delete($id)
    {
        $property = Property::find($id);
        $property->delete();
        return 'Delete Successfully';
        }

    public function getAmenity()
    {
        $property = Property::with('Amenities')->find(1);
        return $property;
    }
    public function getQuestion()
    {
        $property = Property::with('Question', 'Question_option')->find(1);
        return $property;
    }
}
