<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Message;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


use Validator;
use Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
// use Auth;


class UserController extends Controller
{

    function registeruser(Request $req)
    {
        $rules = array(
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => [
                'required', 'confirmed', Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        );
        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // $user = new User();
        // $user->first_name = $req->first_name;
        // $user->last_name = $req->last_name;
        // $user->email = $req->email;
        // $user->password = Hash::make($req->password);
        // $result = $user->save();
        $user = User::create([
            'first_name' => $req->first_name,
            'last_name' => $req->last_name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        if ($user) {
            return response()->json(['msg' => "Done", 'status' => "200", 'data' => $user]);
        } else {
            return ["result" => "error"];
        }
    }
    //Login user
    //******************************************************************************/
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        $user= User::table('users')->get();
        if(!$user->is_verified=0){
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        
        $user = Auth::user();

        $data =
            [
                "success" => "",
                "msg" => "",
                "data" =>
                [
                    "user_id" => "$user->id",
                    "first_name" => "$user->first_name",
                    "last_name" => "$user->last_name",
                    "email" => "$user->email",
                    "token" => "$token"
                ]
            ];
        return $data;
        }
        else{
            $this->verifymail($request->email);
        }
    }
    //******************************************************************************/
    //Verify User
    public function verifymail($email)
    {
        if (auth()->user()) {
            $user = User::where('email', $email)->get();
            if (count($user) > 0) {
                $random = Str::random(40);
                $domain = URL::to('/');
                $url = $domain . '/verify-mail/' . $random;

                $data['url'] = $url;
                $data['email'] = $email;
                $data['title'] = "Email Verification";
                $data['body'] = "Please check here to below to verify your mail";

                Mail::send('verifymail', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])->subject($data['title']);
                });

                $user = User::find($user[0]['id']);
                $user->remember_token = $random;
                $user->save();

                return "Email Sent to you";
            } else {
                return response()->json(['success' => false, 'msg' => 'User is not found']);
            }
        } else {
            return response()->json(['success' => false, 'msg' => 'User is not Authenticated']);
        }
    }
    public function verificationmail($token)
    {
        $user = User::where('remember_token', $token)->get();
        if (count($user) > 0) {
            $datatime = Carbon::now()->format('Y-m-d H:i:s');
            $user = User::find($user[0]['id']);
            $user->remember_token = ' ';
            $user->is_verified = 1;
            $user->email_verified_at = $datatime;
            $user->save();

            return "<h1>Email Verified Successfully..";
        } else {
            return view('404');
        }
    }
}
