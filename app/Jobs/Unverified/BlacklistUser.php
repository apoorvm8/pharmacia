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

class BlacklistUser
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
        $id = $request->input('blacklistId');

        $user = User::find($id);
        if($user->blackList == 0) {
            $user->userBlacklist = 1;
        } else if($user->blackList == 1) {
            $user->userBlacklist = 0;
        }

        $user->save();
        return redirect()->back()->with('success', 'User Blacklisted Successfully');
    }
}
