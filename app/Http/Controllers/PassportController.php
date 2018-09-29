<?php

namespace App\Http\Controllers;

use App\User;
use App\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use GuzzleHttp\Client;
use DB;
use Socialite;

class PassportController extends Controller
{
    use RegistersUsers;
    private $client;

    public function __construct() {

        $this->client = DB::table('oauth_clients')->where('id', 2)->first();
        // die(dd($this->client->id));
    }

    public function sendOtp($otpValue, $mobileNo) {
        
        $message = "Please verify otp: " . $otpValue . " .Never share this otp with anyone";

        $fields = array(
            "sender_id" => "PHARMA",
            "message" => $message,
            "language" => "english",
            "route" => "p",
            "numbers" => $mobileNo,
            "flash" => "1"
        );
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($fields),
          CURLOPT_HTTPHEADER => array(
            "authorization: 6saEAiKQMkqolGWptmBSVhHXxfdyzegIn104buvLZNcUF9RD7Cvpy4VBj9dRqtKnLJhxYMubNoz7UEHg",
            "accept: */*",
            "cache-control: no-cache",
            "content-type: application/json"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        //die($response);
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            return;
           echo $response;
        }
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'retailerName' => $data['retailerName'],
            'shopName' => $data['shopName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobileNo' => $data['mobileNo'],
            'isVerified' => 0,
        ]);
    }

   /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'retailerName' => 'required|string|max:60',
            'shopName' => 'required|string|max:60',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'mobileNo' => 'required|unique:users|digits:10',
        ]);
        
        if($validator->fails()) {
            // Check if user was already sent an otp.
            $validatorError = $validator->failed();
            // die(dd($validatorError));

            if(isset($validatorError['retailerName']) || isset($validatorError['shopName']) || isset($validatorError['email']['Email']) || isset($validatorError['email']['Required']) || isset($validatorError['password']) || isset($validitorError['mobileNo']['Required']) || isset($validatorError['mobileNo']['Digits'])) {

                $response = [
                    'status' => 0,
                    'data' => null,
                    'message' => 'Please verify your fields',
                ];

                return response()->json($response, 200);
            } else if(isset($validatorError['mobileNo']['Unique'])) {
                $response = [
                    'status' => -1,
                    'data' => null,
                    'message' => 'Account already created, login with credentials',
                ];
                return response()->json($response, 200);

            } 
        
        }
        
        event(new Registered($user = $this->create($request->all())));

        //User has been created, enter the otp record.
        $otpValue =  mt_rand(100000, 999999);
         // $otpValue = 123456;
        $checkIfExists = Otp::checkIfOtpExists($otpValue, $request->input('mobileNo'));

        //Generate a unique otp
        while($checkIfExists) {
            $otpValue =  mt_rand(100000, 999999);
            $checkIfExists = Otp::checkIfOtpExists($otpValue, $request->input('mobileNo'));
        }

        $otp = new Otp;
        $otp->mobileNo = $request->input('mobileNo');
        $otp->otp = $otpValue;
        $otp->save();

        $this->sendOtp($otpValue, $request->input('mobileNo'));
        // $this->guard()->login($user);

        return $this->registered($request, $user);
                        // ?: redirect($this->redirectPath());
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $response = [
            "status" => 1,
            "data" => [
                "mobileNo" => $request->input('mobileNo'),
            ],
            "message" => "Your account was created successfully, verify otp to login.",
        ];

        return response()->json($response, 200);
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobileNo' => 'required|digits:10',
            'password' => 'required|string|min:6',
        ]);
        
        if($validator->fails()) {
            $response = [
                'status' => 0,
                'data' => null,
                'message' => 'Please verify your fields',
            ];

            return response()->json($response, 200);
        }

        $credentials = [
            'mobileNo' => $request->input('mobileNo'),
            'password' => $request->input('password'),
        ];

        $mobileNo = $request->input('mobileNo');
        $password = $request->input('password');
        

        if(Auth::attempt(['mobileNo' => $request->input('mobileNo'), 'password' => $request->password,])) {
        
            if(Auth::attempt(['mobileNo' => $request->input('mobileNo'), 'password' => $request->password, 'isVerified' => 0])) {
                $user = User::where('mobileNo', $request->input('mobileNo'))->first();
                $otp = Otp::checkIfOtpMobileExists($user->mobileNo);
                $this->sendOtp($otp, $user->mobileNo);
                
                $response = [
                    'status' => -1,
                    'data' => [
                       'mobileNo' => $user->mobileNo,
                     ],
                    'message' => 'Verify OTP to login',
                ];
    
                return response()->json($response, 200);
            }
        }
        
        $user = User::where('mobileNo', $request->input('mobileNo'))->first();
        if($user != null) {
           if(Auth::attempt(['mobileNo' => $request->input('mobileNo'), 'password' => $request->password,])) {
                $user = Auth::user();

                $http = new \GuzzleHttp\Client;

                $data = $http->post('http://pharmacia.me:8080/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => $this->client->id,
                    'client_secret' => $this->client->secret,
                    'username' => $request->input('mobileNo'),
                    'password' => $request->input('password'),
                    'scope' => '',
                    ],
                ]);

                $data = json_decode((string) $data->getBody(), true);

                $response = [
                    'status' => 1,
                    'data' => $data,
                    'message' => 'You have succesfully logged in',
                ];

                return response()->json($response, 200);
           } else {
             	$response = [
                	'status' => -2,
                	'data' => null,
                	'message'=> 'Invalid credentials, please try again',
             	];

            	return response()->json($response, 200);
           }
        } else {
            $response = [
                'status' => -3,
                'data' => null,
                'message'=> 'You must register to login',
            ];

            return response()->json($response, 200);
        }   
    }

    /**
     * Method for logging through otp verification
     */

    public function loginOtpPartOne(Request $request) {
        $validator = Validator::make($request->all(), [
            'mobileNo' => 'required|digits:10',
        ]);
        
        if($validator->fails()) {
            $response = [
                'status' => 0,
                'data' => null,
                'message' => 'Please verify your fields',
            ];

            return response()->json($response, 200);
        }

        // Check to see if mobile no exists or not
        $user = User::where('mobileNo', $request->input('mobileNo'))->first();
        if($user != null) {
            $user = User::where('mobileNo', $request->input('mobileNo'))->where('isVerified', 1)->first();
            if($user != null) {
                $otpValue = $user->otp;

               $this->sendOtp($otpValue, $request->input('mobileNo'));

                $response = [
                    'status' => 1,
                    'data' => [
                        'mobileNo' => $user->mobileNo,
                    ],
                    'message' => 'Otp sent to your mobile no.',
                ];

                return response()->json($response, 200);
            } else {
                $response = [
                    'status' => -1,
                    'data' => [
                        'mobileNo' => $user->mobileNo,
                        ],
                    'message' => 'Verify OTP to login',
                ];
        
                return response()->json($response, 200);
            }
        } else {
            $response = [
                'status' => -3,
                'data' => null,
                'message'=> 'You must register to login',
            ];

            return response()->json($response, 200);
        }   
    }


    public function loginOtpPartTwo(Request $request) {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|digits:6',
            'mobileNo' => 'required|digits:10',
        ]);    

        if($validator->fails()) {
            $response = [
                'status' => 0,
                'data' => null,
                'message' => 'Please verify your fields',
            ];

            return response()->json($response, 200);
        }

        $user = User::where('otp', $request->input('otp'))->first();
        
        if($user == null) {
            $response = [
                'status' => -1,
                'data' => null,
                'message' => 'Otp you entered is incorrect.',
            ];

            return response()->json($response, 200);
        } else {
            $http = new \GuzzleHttp\Client;

            $data = $http->post('http://pharmacia.me:8080/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $this->client->id,
                'client_secret' => $this->client->secret,
                'username' => $request->input('mobileNo'),
                'password' => $request->input('password'),
                'scope' => '',
                ],
            ]);

            $data = json_decode((string) $data->getBody(), true);

            $response = [
                'status' => 1,
                'data' => $data,
                'message' => 'You have succesfully logged in',
            ];

            return response()->json($response, 200);
            
        }
    }

    public function refresh(Request $request) {

        $validator = Validator::make($request->all(), [
            'refresh_token' => 'required',
        ]);

        if($validator->fails()) {
            $response = [
                'status' => 0,
                'data' => null,
                'message' => 'Please verify your fields',
            ];

            return response()->json($response, 200);
        }

        $http = new \GuzzleHttp\Client;

        $data = $http->post('http://pharmacia.in/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $request->input('refresh_token'),
                'client_id' => $this->client->id,
                'client_secret' => $this->client->secret,
                'scope' => '',
            ],
        ]);

        $data = json_decode((string) $data->getBody(), true);

        $response = [
            'status' => 1,
            'data' => $data,
            'message' => 'Token refreshed successfully',
        ];

        return response()->json($response, 200);
    }

    public function logout() {
        $accessToken = Auth::user()->token();
        
        DB::table('oauth_refresh_tokens')->where('access_token_id', $accessToken->id)->update(['revoked' => true]);

        $accessToken->revoke();

        $response = [
            'status' => 1,
            'data' => null,
            'message' => 'You are now logged out'
        ];

        return response()->json($response, 200);
    }
    

    public function changePassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()) {
            $errors = $validator->failed();
            // if(isset($errors['oldPassword']['Required'])){
                // die("OK");
            // } 
            $response = [
                'status' => 0,
                'data' => null,
                'message' => 'Please verify your fields',
            ];

            return response()->json($response, 200);
        }

        $user = Auth::user();
        $password = $user->password;
    
        if(!Hash::check($request->input('oldPassword'), $password)) {
            $response = [
                'status' => -1,
                'data' => null,
                'message' => 'Please verify your old password and try again',
            ];

            return response()->json($response, 200);
        } else {
            $user = Auth::user();
            $user->password = Hash::make($request->input('password'));
            $user->save();

            $response = [
                'status' => 1,
                'data' => null,
                'message' => 'Password changed successfully.',
            ];

            return response()->json($response, 200);
        }  
    }

     public function forgotPasswordPartOne(Request $request) {

        $validator = Validator::make($request->all(), [
            'mobileNo' => 'required|digits:10',
        ]);    

        if($validator->fails()) {
            $response = [
                'status' => 0,
                'data' => null,
                'message' => 'Please verify your fields',
            ];

            return response()->json($response, 200);
        }

        $user = User::where('mobileNo', $request->input('mobileNo'))->first();
        
        if($user == null) {
            $response = [
                'status' => -1,
                'data' => null,
                'message' => 'Mobile no not found in records.',
            ];

            return response()->json($response, 200);
        } else {

            $otpValue = $user->otp;

            $this->sendOtp($otpValue, $request->input('mobileNo'));

            $response = [
                'status' => 1,
                'data' => [
                    'mobileNo' => $user->mobileNo,
                ],
                'message' => 'Otp sent to your mobile no.',
            ];

            return response()->json($response, 200);
            
        }
    }

    public function forgotPasswordPartTwo(Request $request) {

        $validator = Validator::make($request->all(), [
            'otp' => 'required|digits:6'
        ]);    

        if($validator->fails()) {
            $response = [
                'status' => 0,
                'data' => null,
                'message' => 'Please verify your fields',
            ];

            return response()->json($response, 200);
        }

        $user = User::where('otp', $request->input('otp'))->first();
        
        if($user == null) {
            $response = [
                'status' => -1,
                'data' => null,
                'message' => 'Otp you entered is incorrect.',
            ];

            return response()->json($response, 200);
        } else {

            $response = [
                'status' => 1,
                'data' => [
                    'userId' => $user->id,
                ],
                'message' => 'You can now change your password.',
            ];

            return response()->json($response, 200);
            
        }
    }

    public function forgotPasswordPartThree(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()) {
            $response = [
                'status' => 0,
                'data' => null,
                'message' => 'Please verify your fields',
            ];

            return response()->json($response, 200);
        }

        $user = User::find($request->input('id'));

        if($user == null) {
            $response = [
                'status' => -1,
                'data' => null,
                'message' => 'No records found',
            ];

            return response()->json($response, 200);   
        } else {
        
                       
            $user->password = Hash::make($request->input('password'));
            $user->save();
            
            $response = [
                'status' => 1,
                'data' => null,
                'message' => 'Password changed succesfully',
            ];

            return response()->json($response, 200);   
        }

    }


    public function getDetail() {
        $user = Auth::user();
        return response()->json(['user' => $user], 200);
    }

    public function redirect(Request $request, $service) {
        $service = $request->route()->parameter('service');
        return Socialite::driver($service)->with(["access_type" => "offline", "prompt" => "consent select_account"])->stateless()->redirect();
    }

    public function callback(Request $request, $service) {
        $service = $request->route()->parameter('service');

        $googleUser = Socialite::driver($service)->stateless()->user();
        die(dd($googleUser));
        if($googleUser != null) {
            

            $response = [
                'status' => 1,
                'data' => $data,
                'message' => 'You have succesfully logged in',
            ];

            return response()->json($response, 200);
        } else if($user == null) {
            $response = [
                'status' => 0,
                'data' => null,
                'message' => 'Please verify your old password and try again',
            ];
            
            return response()->json($response, 200);
        }
    }

}
