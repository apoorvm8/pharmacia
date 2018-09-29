<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    
    public static function checkIfOtpExists($otpValue, $mobileNo) {

        $otp = Otp::where('otp', $otpValue)->where('mobileNo', $mobileNo)->first();

        if($otp == null) {
            return false;
        } else {
            return true;
        }
    }

    public static function checkIfOtpMobileExists($mobileNo) {
        $otp = Otp::where('mobileNo', $mobileNo)->first();

        if($otp == null) {
            return false;
        } else {
            return $otp->otp;
        }
    }
}
