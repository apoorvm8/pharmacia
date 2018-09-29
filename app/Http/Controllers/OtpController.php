<?php

namespace App\Http\Controllers;

use App\User;
use App\Otp;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    

    public function verifyOtp(Request $request) {

        $validator = Validator::make($request->all(), [
            'mobileNo' => 'required|digits:10',
            'otp' => 'required',
        ]);

        if($validator->fails()) {
            $response = [
                'status' => 0,
                'data' => null,
                'message' => 'Please verify your fields',
            ];

            return response()->json($response, 401);
        }

        // Fetch the otp from the request object
        $otpValue = $request->input('otp');
        $mobileNo = $request->input('mobileNo');
        
        // Get the otp object
        $otp = Otp::where('mobileNo', $mobileNo)->where('otp', $otpValue)->first();
        if($otp == null) {
            $response = [
                'status' => -1,
                'data' => null,
                'message' => 'Otp you provided is incorrect',
            ];

            return response()->json($response, 404);
        } else {
            $user = User::where('mobileNo', $mobileNo)->first();
            $user->isVerified = 1;
            $user->otp = $otpValue;
            $user->save();
    
            $otp->delete();
            $response = [
                'status' => 1,
                'data' => null,
                'message' => 'Otp verified successfully, you can login now.',
            ];
    
            return response()->json($response, 200);
            
        }
    }
}
