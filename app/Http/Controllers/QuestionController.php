<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Question_option;
use Validator;

class QuestionController extends Controller
{
    //
    public function QuestionController(Request $req)
    {
        $rules = array(
            'title' => 'required|max:255',
            'type' => 'required|Integer|max:255',
            'has_other' => 'required|Integer|max:255',
        );
        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        };
        $user = auth()->user()->id;
        $question = Question::create([
            'title' => $req->title,
            'type' => $req->type,
            'has_other' => $req->has_other,
            'user_id' => $user
        ]);
        $arr = [];
        foreach ($req->options as $option) {
            $questionoption = new Question_option();
            $questionoption->text = $option['text'];
            $questionoption->preferred = $option['preferred'];
            $questionoption->question_id = $question->id;
            $questionoption->save();
            $arr[] = $questionoption;
        }
        if ($question) {
            return response()->json([
                "statusCode" => 200,
                "message" => "Question added sucessfully",
                'data' => $question,
                'options' => $arr
            ]);
        } else {
            return ["result" => "error"];
        }
    }
    public function getQuestions()
    {
        $question = Question::with('question_options')->find(13);
        // $images= User::find(2)->images;
        return $question;
    }
}
