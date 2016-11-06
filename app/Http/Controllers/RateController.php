<?php

namespace Coclus\Http\Controllers;

use Illuminate\Http\Request;

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
        $rating = new Rating;
        $rating->rating = $vote;
        $rating->user_id = $professional_id;
        $professional->ratings()->save($rating);

        return back();
    }
}
