<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use DB;

class UsersController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
        $this->middleware('role:admin');
    }

    public function userOrders(Request $request, $id) {
        $id = $request->route()->parameter('id');
        $user = User::find($id);

        $orders = DB::table('users')->join('orders', function($join) use($id){
            $join->on('orders.userId', '=', 'users.id')->where('users.id', $id);
        })->get();

        return view('admins.users.orders')->with(['user' => $user, 'orders' => $orders]);
    }

    /**
     * Display a listing of the verified user
     *
     * @return \Illuminate\Http\Response
     */
    public function verifiedUsers()
    {
        // Fetch the users who are completetly verified
        $users = User::where('isVerified', true)->where('verificationStatus', 2)->where('userBlacklist', 0)->get();

        return view('admins.users.verified')->with(['users' => $users]);
    }

     /**
     * Display a listing of the unverified user
     *
     * @return \Illuminate\Http\Response
     */
    public function unverifiedUsers()
    {
        // Fetch the users who are isVerfied = 1 but verifificationStatus = 0
        $users = User::where('isVerified', true)->where('verificationStatus', 0)->where('userBlacklist', 0)->get();

        return view('admins.users.unverified')->with(['users' => $users]);
    }

     /**
     * Display a listing of the incomplete user
     *
     * @return \Illuminate\Http\Response
     */
    public function intermediateUsers()
    {
        // Fetch the users who are isVerfied = 1 but verifificationStatus = 0
        $users = User::where('isVerified', true)->where('verificationStatus', 1)->where('userBlacklist', 0)->get();

        return view('admins.users.intermediate')->with(['users' => $users]);
    }

     /**
     * Display a listing of the blacklist user
     *
     * @return \Illuminate\Http\Response
     */
    public function blacklistUsers()
    {
        // Fetch the users who are isVerfied = 1 and blacklist = true
        $users = User::where('isVerified', true)->where('userBlacklist', 1)->get();

        return view('admins.users.blacklist')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $id = $request->parameter('id');
        $user = User::find($id);
        $username = strtolower($user->firstName . $user->lastName) . "_" . $user->id;
        if(($user->gstNoImage != null) || ($user->drugNoImage != null)) {
            Storage::delete("public/users/$username");
        }

        $user->delete();

        return redirect()->back()->with('success', 'User removed from record successfully');
    }

    public function findUnverifiedUpdate(Request $request) {
        if ($request->has('gstUserId')) {
            return $this->dispatch(new \App\Jobs\Unverified\VerifyGstNo($request));
        } else if ($request->has('drugUserId')) {
            return $this->dispatch(new \App\Jobs\Unverified\VerifyDrugNo($request));
        } else if ($request->has('blacklistId')) {
            return $this->dispatch(new \App\Jobs\Unverified\BlacklistUser($request));
        }

        return 'no action found';
    }
}
