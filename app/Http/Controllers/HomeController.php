<?php

namespace Coclus\Http\Controllers;

use Auth;
use Carbon\Carbon;

use Coclus\Http\Requests;
use Coclus\Status;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setLocale('es');

        $statuses = Status::notReply()->where(function($query){
            return $query->where('user_id', Auth::user()->id)
                    ->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('timeline')->with('statuses', $statuses);
    }




}
