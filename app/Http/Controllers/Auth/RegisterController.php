<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => 'required|string|max:60',
            'lastName' => 'required|string|max:60',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'mobileNo' => 'required|unique:users|digits:10',
            'gstImage' => 'nullable|image|max:5999',
            'drugImage' => 'nullable|image|max:5999',
            'drugNo' => 'nullable|unique:users',
            'gstNo' => 'nullable|unique:users',
        ]);
    }
 
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {

        $user = new User;

        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->mobileNo = $request->input('mobileNo');
        $user->gstNo = $request->input('gstNo');
        $user->drugNo = $request->input('drugNo');
        $user->isVerified = 1;

        $user->save();

        $user = User::find($user->id);
        // die(dd($user));
         // Handle gst image upload
         if($request->hasFile('gstImage')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('gstImage')->getClientOriginalName();

            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('gstImage')->getClientOriginalExtension();

            // File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $nameOfFolder = $user->firstName . $user->lastName . "_" . $user->id;
            $nameOfFolder = strtolower($nameOfFolder);
            $path = $request->file('gstImage')->storeAs("public/users/$nameOfFolder", $fileNameToStore);
        }


        if($request->hasFile('gstImage')) {
            $user->gstNoImage = $fileNameToStore;
        }

        
        // Handle drug image upload
        if($request->hasFile('drugImage')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('drugImage')->getClientOriginalName();

            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('drugImage')->getClientOriginalExtension();

            // File name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $nameOfFolder = $user->firstName . $user->lastName . "_" . $user->id;
            $nameOfFolder = strtolower($nameOfFolder);

            $path = $request->file('drugImage')->storeAs("public/users/$nameOfFolder", $fileNameToStore);
        }

        if($request->hasFile('drugImage')) {
            $user->drugNoImage = $fileNameToStore;
        }

        $user->save();
        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request)));

        return $this->registered($request, $user)
        ?: redirect()->route('login')->with('success', 'Account Created, You can login now');
    }
}
