<?php
namespace Auth\OTP\Provider;

use Auth\OTP\Contract\OTP;
use Illuminate\Support\Facades\Auth;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Kavenegar\KavenegarApi;
use User\Model\User;

class OTPKaveNegarProvider extends OTP
{
    protected function sendOTP($mobile)
    {

        $user = User::firstOrCreate([
            'mobile' => $mobile,
        ]);

        try{
            $api = new KavenegarApi("7446716556497832484F577478474465795A39717A4F473169726F422F5A77737A4269324D6A416147496F3D");
            $template = "verify";
            $token = User::generateCode();
            $receptor = $mobile;
            $type = "sms";
            $result = $api->VerifyLookup($receptor,$token,$token,$token,$template,$type);
            if($result){
                $user->activeCode = $token;
                $user->expired_at = now()->addMinutes(2);
                $user->save();

                return response()->json([
                    'status' => 'success',
                    'data' => [
                        'user' => $user,
                    ],
                ]);
            }
        }
        catch(ApiException $e){
            echo $e->errorMessage();
        }
        catch(HttpException $e){
            echo $e->errorMessage();
        }
    }

    protected function verifyOTP($mobile, $otp)
    {

        $user = User::whereMobile($mobile)->first();

        $status = User::verifyCode($otp , $user);

        if(! $status) {
            return response()->json([
                'status' => 'failed',
                'data' => [
                    'user' => $user,
                ],
            ]);
        }

        Auth::login($user);

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user,
            ],
        ]);

    }
}
