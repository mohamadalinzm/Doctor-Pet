<?php

use Tests\TestCaseAuth;
use Auth\Support\MobileHelper;

class MobileHelperTest extends TestCaseAuth
{
    // Test the getMobileWithoutPrefix() method
    public function testGetMobileWithoutPrefix()
    {
        $mobile = '00989123456789';
        $prefix = '00';
        $expected = '989123456789';
        $actual = MobileHelper::getMobileWithoutPrefix($mobile, $prefix);
        $this->assertEquals($expected, $actual);
    }

    // Test the getMobileWithCountryCode() method
    public function testGetMobileWithCountryCode()
    {
        // Set config value
        config(['auth_config.default_mobile_country_code' => '+971']);
        $mobile = '989123456789';
        $expected = '+971989123456789';
        $actual = MobileHelper::getMobileWithCountryCode($mobile);
        $this->assertEquals($expected, $actual);
    }
}
