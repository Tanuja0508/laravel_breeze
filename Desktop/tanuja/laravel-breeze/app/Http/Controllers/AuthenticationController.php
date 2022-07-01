<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;




class AuthenticationController extends Controller
{

      //////////////////////register api/////////////////////////////////////////////
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
         
        ]);
        if ($validator->fails()) 
        { 
             return response()->json(['error'=>$validator->errors()], 401);            
         }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();
        $token = $user->createToken('auth_token')->plainTextToken;
    
        // return response()->json([
        //     "message" => "User Register Successfully"
        // ], 201);
        return response()->json(['success'=>$user, "message" => "User Register Successfully","token"=>$token]); 
       }



      //////////////////////login api/////////////////////////////////////////////

      public function login(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'password' => 'required',
            'email' => 'required'
           ]);
        if ($validator->fails()) 
        { 
        return response()->json(['error'=>$validator->errors()], 401);            
         }
         $credentials = request(['email', 'password']);
         if(!Auth::attempt($credentials)){
            return response()->json([
                'message'=> 'Invalid email or password'
            ], 401);
        }
       
        $user = $request->user();
        // $token = $user->createToken('Access Token');
        $user->access_token =  $user->createToken('auth_token')->plainTextToken;
        return response()->json([
               "user"=>$user,"message"=>"Login Successfully"
         ], 200);
        
      }



       //////////////////////forget api/////////////////////////////////////////////
       public function forgotPassword(Request $request) {
       
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email|exists:users',
           ]);
        if ($validator->fails()) 
        { 
        return response()->json(['error'=>$validator->errors()], 401);            
         }
        $body = [
        'name'=>'edjkkjdkjkl',
        'url_a'=>'https://www.bacancytechnology.com/',
       'url_b'=>'https://www.bacancytechnology.com/tutorials/laravel',
        ];

    Mail::to('tanuja.enact@gmail.com')->send(new TestMail($body));


    }




    //////////////////////////update password ////////////////////////
    function updatePassword(Request $request){
        
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
           
            $user['password'] = Hash::make($request->password);
            $user->save();
            return response()->json([
               "message"=>"Password updated Successfully"
          ], 200);
            }
        return response()->json([
            "message"=>"Failed ! something went wrong"
       ], 200);
        }


            ///////////////reset Password/////////////
      function resetPassword(){
          return view('ResetPassword');
      }

}




 //  $status =  Password::sendResetLink($request->email);
    //      if($response == Password::RESET_LINK_SENT){
    //         $message = "Mail send successfully";
    //         }else{
    //         $message = "Email could not be sent to this email address";
    //         }
    //         $response = ['data'=>'','message' => $message];
    //        return response($response, 200);



    // $status = Password::sendResetLink(
    //     $request->email
    // );

    // if ($status == Password::RESET_LINK_SENT) {
    //     return [
    //         'status' => __($status)
    //     ];
    // }

    // throw ValidationException::withMessages([
    //     'email' => [trans($status)],
    // ]);



// $response = Password::sendResetLink($request->only('email'), function (Message $message) {
//                 $message->subject($this->getEmailSubject());
// });
// switch ($response) {
//     case Password::RESET_LINK_SENT:
//         return \Response::json(array("status" => 200, "message" => trans($response), "data" => array()));
//     case Password::INVALID_USER:
//         return \Response::json(array("status" => 400, "message" => trans($response), "data" => array()));
// }
//         return response->json($arr);

    // $input = $request->only('email','token', 'password', 'password_confirmation');
    // $validator = Validator::make($input, [
    // 'token' => 'required',
    // 'email' => 'required|email',
    // 'password' => 'required|confirmed|min:8',
    // ]);
    // if ($validator->fails()) {
    // return response(['errors'=>$validator->errors()->all()], 422);
    // }
    // $response = Password::reset($input, function ($user, $password) {
    // $user->forceFill([
    // 'password' => Hash::make($password)
    // ])->save();
    // //$user->setRememberToken(Str::random(60));
    // event(new PasswordReset($user));
    // });
     
    // if($response == Password::PASSWORD_RESET){
    // $message = "Password reset successfully";
    // }else{
    // $message = "Email could not be sent to this email address";
    // }
    
    // $response = ['data'=>'','message' => $message];