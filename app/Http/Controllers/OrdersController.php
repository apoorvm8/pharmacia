<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Order;
use App\DetailOrder;
use DB;

class OrdersController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
        $this->middleware('role:admin');
    }


    public function byVerifiedUsers(Request $request) {

        $orders = DB::table('users')->join('orders', 'orders.userId', '=', 'users.id')->where('users.isVerified', true)->where('users.verificationStatus', 2)->where('users.userBlacklist', 0)->get();

        // die(dd($orders));
        return view('admins.orders.byVerified')->with(['orders' => $orders]);
    }

    public function byUnverifiedUsers(Request $request) {
        $orders = DB::table('users')->join('orders', 'orders.userId', '=', 'users.id')->where('users.isVerified', true)->where('users.verificationStatus', 0)->where('users.userBlacklist', 0)->get();

        // die(dd($orders));
        return view('admins.orders.byUnverified')->with(['orders' => $orders]);
    }

    public function byIntermediateUsers(Request $request) {
        $orders = DB::table('users')->join('orders', 'orders.userId', '=', 'users.id')->where('users.isVerified', true)->where('users.verificationStatus', 1)->where('users.userBlacklist', 0)->get();

        // die(dd($orders));
        return view('admins.orders.byIntermediate')->with(['orders' => $orders]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show(Request $request, $id)
    {
        $id = $request->route()->parameter('id');
        $order = Order::find($id);

        $detailOrders = DB::table('orders')->join('detail_orders', function($join) use($id) {
            $join->on('orders.id', '=', 'detail_orders.orderId')->where('orders.id', '=', $id);
        })->join('medicines', 'medicines.id', '=', 'detail_orders.productId')->get();


        return view('admins.orders.detailOrder')->with(['order' => $order, 'detailOrders' => $detailOrders]);
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
    public function destroy($id)
    {
        //
    }
}
