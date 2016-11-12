<?php

namespace Coclus\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use willvincent\Rateable\Rating;
use Coclus\Professional;
use Coclus\Http\Requests;

class RateController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function rate($professional_id, $vote) {
        $professional = Professional::where('user_id', $professional_id)->first();

        $user_rated = DB::table('votes')->where('user_id', Auth::user()->id)->first();
        if ($user_rated) { alert()->error('Al parecer ya votaste a este Profesional.', 'Error'); return back(); }

        $rating = new Rating;
        $rating->rating = $vote;
        $rating->user_id = $professional_id;
        $professional->ratings()->save($rating);

        DB::table('votes')->insert([
            'user_id'   => Auth::user()->id,
            'rating_id' => $rating->id,
        ]);

        return back();
    }
}
