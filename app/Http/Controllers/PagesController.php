<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    
    public function index() {
        // return view('pages.index');
        return view('pages.home');
    }


    public function index_email(Request $request) {
        $name = $request->input('name');
        $email = $request->input('email');
        $mobile_no = $request->input('mobileNo');

        $data = array("name" => $name, "mobile_no" => $mobile_no, "email" => $email);
        // die($email);
        Mail::send("layouts.mail", $data, function($message) use ($email) {
            $message->to($email, '')->subject("Thank you for booking appointment");
            $message->from("contact@pharmacia.in", "Pharmacia");
        });

        return;
    }
}
