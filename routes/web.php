<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Kavenegar\KavenegarApi;
use Morilog\Jalali\Jalalian;
use Tymon\JWTAuth\Facades\JWTAuth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test5',function(){
    auth()->logout();
    $user = User::query()->find(1);
    $user2 = auth()->loginUsingId($user->id);
    $token = JWTAuth::fromUser($user2);
    return response()->json($token);
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/otp',function(){
    $api = new KavenegarApi("7446716556497832484F577478474465795A39717A4F473169726F422F5A77737A4269324D6A416147496F3D");
    $template = "verify";
    $token = '123456';
    $receptor = '09357714417';
    $type = "sms";
    $result = $api->VerifyLookup($receptor,$token,$token,$token,$template,$type);
});

Route::get('/date',function(){
    $data = Jalalian::forge('13:30')->addMinutes(20)->format('H:i');
    $date = Jalalian::forge($data)->addMinutes(20)->format('H:i');
    dd($data,$date);
});

