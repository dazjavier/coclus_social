<?php

namespace Coclus\Http\Controllers;

use Illuminate\Http\Request;

use Coclus\User;
use Coclus\Deaf;
use Coclus\Professional;
use Coclus\Familiar;
use Coclus\Speciallity;
use Coclus\CommunicationType;

use Coclus\Http\Requests;
use Auth;
use DB;

class ProfileController extends Controller
{
    public function index() {
        $userId     = Auth::user()->id;
        $deaf       = Deaf::where('user_id', $userId)->get();
        $familiar   = Familiar::where('user_id', $userId)->first();

        return view('logged.profiles.information')
        ->with('deaf', $deaf)
        ->with('familiar', $familiar);
    }

    public function showLoggedUserStatuses() {
        $statuses = Auth::user()->statuses()->notReply()->limit(5)->get();

        return view('logged.profiles.statuses')->with('statuses', $statuses);
    }

    public function showUser($username) {
        $user = User::where('username', $username)->first();
        if (Auth::check()) {
            if ($user->username == Auth::user()->username) {
                return redirect('/my_profile');
            }
        }

        $user_profile_type = $user->profile_type;
        $familiar = "";

        if ($user_profile_type == "familiar") {
            $familiar = Familiar::where('user_id', $user->id)->first();
            $user_type = Deaf::where('user_id', $user->id)->get();
        } else if ($user_profile_type == "professional") {
            $user_type = Professional::where('user_id', $user->id)->first();
        } else {
            $user_type = Deaf::where('user_id', $user->id)->get();
        }

        return view('users.information')
        ->with('familiar', $familiar)
        ->with('user', $user)
        ->with('user_type', $user_type);
    }

    public function showUserStatuses($username) {
        $user = User::where('username', $username)->first();
        $statuses = $user->statuses()->notReply()->limit(5)->get();

        if (Auth::check()) {
            if ($user->username == Auth::user()->username) {
                return redirect('/my_profile');
            }
        }

        return view('users.statuses')
        ->with('user', $user)
        ->with('statuses', $statuses);
    }

    public function getUserByUsername($username) {
        return $user = User::where('username', $username)->first();
    }

    public function getInterestsByUserId($userId) {
        return $interest = DB::table('interest')->where('user_id', $userId)->get();
    }

    public function getProfileTypeByUserId($profile_type, $userId) {
        return $type = DB::table($profile_type)->where('user_id', $userId)->get();
    }
}
