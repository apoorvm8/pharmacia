<?php

namespace App\Jobs\Unverified;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Validator;
use App\User;
use DB;

class VerifyGstNo
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        $userId = $request->input("gstUserId");

        $user = User::find($userId);

        $user->gstVerificationStatus = 1;
        $user->verificationStatus = 0;
        $user->verificationStatus = $user->gstVerificationStatus + $user->drugVerificationStatus;
        $user->save();
        $message = "Successfully verified gst no user";

        return response()->json(["message" => $message], 200);
    }
}
