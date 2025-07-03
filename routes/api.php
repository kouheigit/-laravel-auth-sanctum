<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\PostController;
use Illuminate\Validation\ValidationException;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::apiResource('posts', PostController::class);

Route::post('/login',function(Request $request){

   $request->validate([
       'email'=>['required','email'],
       'password'=>['required'],
   ]);

   //user情報を取得する
   $user = User::where('email',$request->email)->first();
   if(!$user|| !Hash::check($request->password,$user->password)){
       throw ValidationException::withMessages([
           'email'=>['認証に失敗しました。メールアドレスまたはパスワードが間違っています。']
       ]);
   }
    return ['token' => $user->createToken('api-token')->plainTextToken];
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
