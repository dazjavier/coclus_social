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
        $com_types      = array();
        $userId         = Auth::user()->id;
        $profile_type   = Auth::user()->profile_type;

        $interest       = $this->getInterestsByUserId($userId);
        $statuses       = Auth::user()->statuses()->notReply()->limit(6)->get();

        $deaf_communication_types = Deaf::where('user_id', $userId)->get();

        for ($i=0; $i < $deaf_communication_types->count(); $i++) {
            if ($deaf_communication_types[$i] !== null){
                array_push($com_types, $deaf_communication_types[$i]->getCommunicationTypes());
            }
        }

        if ($profile_type == "professional") {
            $professional   = Professional::where('user_id', $userId)->first();
            $speciallity    = $professional->getSpeciallity();

            return view('logged.profile')
                    ->with('com_types', $com_types)
                    ->with('professional', $professional)
                    ->with('speciallity', $speciallity)
                    ->with('interest', $interest)
                    ->with('statuses', $statuses);
        }

        if ($profile_type == "familiar") {
            $familiar = Familiar::where('user_id', $userId)->first();
            return view('logged.profile')
                    ->with('com_types', $com_types)
                    ->with('familiar', $familiar)
                    ->with('interest', $interest)
                    ->with('statuses', $statuses);
        }

        return view('logged.profile')
                ->with('com_types', $com_types)
                ->with('interest', $interest)
                ->with('statuses', $statuses);
    }

    public function showUser($username) {
        $com_types = array();
        $u = $this->getUserByUsername($username);

        if (! $u) {
            abort(404);
        }

        if ($u == Auth::user()) {
            return redirect('/my_profile');
        }

        $options = array();

        $userId = $u->id;
        $interests = $this->getInterestsByUserId($userId);
        $profile_type = $this->getProfileTypeByUserId($u->profile_type, $userId);

        $deaf_communication_types = Deaf::where('user_id', $userId)->get();

        for ($i=0; $i < $deaf_communication_types->count(); $i++) {
            if ($deaf_communication_types[$i] !== null){
                array_push($com_types, $deaf_communication_types[$i]->getCommunicationTypes());
            }
        }

        array_push($options, $profile_type[0]);
        $statuses = $u->statuses()->notReply()->limit(6)->get();
        return view('users.profile')
            ->with('com_types', $com_types)
            ->with('u', $u)
            ->with('familiar', $options)
            ->with('interest', $interests)
            ->with('statuses', $statuses)
            ->with('authIsFriend', $u->isFriendWith($u));
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
