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

class VerifyDrugNo
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
        $userId = $request->input("drugUserId");

        $user = User::find($userId);

        $user->drugVerificationStatus = 1;
        $user->verificationStatus = 0;
        $user->verificationStatus = $user->gstVerificationStatus + $user->drugVerificationStatus;
        $user->save();
        $message = "Successfully verified drug no user";

        return response()->json(["message" => $message], 200);
    }
}
