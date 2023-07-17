<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class CheckLoggedInStatus
{
    public function handle($request, Closure $next)
    {
        // Check if the user is logged in based on the cookie and the user key in the database
        $loggedIn = false;
        $userKey = Cookie::get('loggedIn');
        // dd($userKey);
        if ($userKey) {
            $user = User::where('LOGGED_IN_STATUS', $userKey)->first();
            // dd($user);
            if (isset($user)) {
                // dd($user);
                // Perform any additional checks if needed
                $loggedIn = true;
                // dd($user);
            }

        }
        // dd($loggedIn);

        // Set the authentication status based on the logged-in status
        if ($loggedIn == true) {
            $request->session()->put([
                'userId' => $user->USER_ID,
                'userName' => $user->USER_NAME,
                'firstName' => $user->FIRST_NAME,
                'lastName' => $user->LAST_NAME,
                'userType' => $user->USER_TYPE,
                'email' => $user->EMAIL,
                'userSubType' => $user->USER_SUBTYPE
            ]);

        } else {
            Auth::logout();
        }
        return $next($request);
    }
}
