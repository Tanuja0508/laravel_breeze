<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthenticationController;
use App\Models\User;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
// use Mail;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

Route::post('/sanctum',[UserController::class,'index']);

// Route::get('/sanctum',function(){
//     echo "yes";
// });


// Route::get('/tokens/create', function (Request $request) {
//     $user=User::get()->first();
//     $token = $user->createToken($request->token_name);
 
//     return ['token' => $token->plainTextToken];
// });

//custom api route
Route::get('/students', [ApiController::class,'getAllStudents']);
Route::get('/students/{id}', [ApiController::class,'getStudent']);
Route::post('/createstudents', [ApiController::class,'createStudent']);
Route::put('/updatestudents/{id}', [ApiController::class,'updateStudent']);
Route::delete('/deletestudents/{id}',[ApiController::class,'deleteStudent']);



//authentication module
Route::post('/registerUser', [AuthenticationController::class,'register']);
Route::post('/loginUser', [AuthenticationController::class,'login']);
Route::post('/forgotPassword', [AuthenticationController::class,'forgotPassword']);
Route::post('/updatePassword', [AuthenticationController::class,'updatePassword']);
Route::get('/resetPassword', [AuthenticationController::class,'resetPassword']);

Route::get('/email', function(){
//    $body = [
//         'name'=>'edjkkjdkjkl',
//         'url_a'=>'https://www.bacancytechnology.com/',
//        'url_b'=>'https://www.bacancytechnology.com/tutorials/laravel',
//     ];

//     Mail::to('tanuja.enact@gmail.com')->send(new TestMail($body));
// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/identitytoolkit/v3/relyingparty/sendVerificationCode?key=AIzaSyB4jtkYgM8bqllAlTJqpwURkyAgT8ddYGc');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n     \"phoneNumber\": \"+61 488 827 343\",\n     }");

// $headers = array();
// $headers[] = 'Content-Type: application/json';
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// $result = curl_exec($ch);
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// curl_close($ch);
// print_r($result);


return view('abc');
});




