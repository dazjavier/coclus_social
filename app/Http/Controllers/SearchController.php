<?php

namespace Coclus\Http\Controllers;

use Alert;
use Coclus\User;
use DB;
use Illuminate\Http\Request;

use Coclus\Http\Requests;

class SearchController extends Controller
{
    public function getResults(Request $request) {
        $query = $request->input('q');

        if (! $query) {
            alert()->error('Debes ingresar algo para buscar!', 'Error')->autoClose(3000);
            return redirect()->back();
        }

        $users = User::where(DB::raw("CONCAT(name, ' ', lastname)"), 'LIKE', "%{$query}%")
                    ->orWhere('username', 'LIKE', "%{$query}%")
                    ->get();

        return view('search.results')->with('users', $users);
    }

}
