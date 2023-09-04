<?php

namespace Auth\Service\Partition\admin\Validation;

use App\Rules\AlphaSpace;
use Auth\Support\AuthMessage;
use General\Facade\GeneralFacade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserRegisterValidator
{
    public static function check(array $data, $validateRecaptcha = true)
    {
        $rules = [
            'name' => ['required', 'max:50', new AlphaSpace],
            'mobile' => ['required', 'string','min:9','max:12'],
            'country_code' => [
                'required',
                Rule::in(GeneralFacade::getFilteredPhoneCode())
            ],
            'role' => [
                'required',
                'in:seller,buyer',
            ],
            'terms' => [
                'required',
                'accepted',
            ],
            'g-recaptcha-response' => 'required|recaptchav3:register,0.5'
        ];

        $currentRouteName = request()->route()->getName();
        $isApiRequest = Str::startsWith($currentRouteName, 'api.');

        $isDevelopmentEnv = app()->environment('local') || app()->environment('development') || app()->environment('testing');

        if (!$validateRecaptcha or $isApiRequest or $isDevelopmentEnv) {
            unset($rules['g-recaptcha-response']);
        }

        $messages =  [
            'terms.required' => AuthMessage::$acceptTermAndConditions,
        ];

        return Validator::make($data, $rules, $messages);
    }
}
