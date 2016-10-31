<?php

namespace Coclus\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Coclus\User;

use Coclus\Http\Requests;

class FriendController extends Controller
{

    public function index() {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();



        return view('logged.friends.index')->with('requests', $requests)->with('friends', $friends);
    }

    public function getAdd($username) {
        $user = User::where('username', $username)->first();

        if (! $user) {
            alert()->error('El usuario no ha sido encontrado.', 'Error')->autoclose(3000);
            return redirect('/timeline');
        }

        if (Auth::user()->id == $user->id) {
            return redirect('/my_profile');
        }

        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
            alert()->info('Ya hay una solicitud de amistad pendiente.', 'Información')->autoclose(3000);
            return redirect()->back();
        }

        if (Auth::user()->isFriendWith($user)) {
            alert()->info("Tú y {$user->name} ya son amigos.", 'Información')->autoclose(3000);
            return redirect()->back();
        }

        Auth::user()->addFriend($user);

        return redirect()->back();

    }
    
    public function getAccept($username) {
        $user = User::where('username', $username)->first();

        if (! $user) {
            alert()->error('El usuario no ha sido encontrado.', 'Error')->autoclose(3000);
            return redirect('/timeline');
        }

        if (!Auth::user()->hasFriendRequestReceived($user)) {
            alert()->info("Tú y {$user->name} ya son amigos.", 'Información')->autoclose(3000);
            return redirect('/users/' . $user->username);
        }

        Auth::user()->acceptFriendRequest($user);

        alert()->success("Tú y {$user->name} ahora son amigos.", 'Éxito')->autoclose(3000);
        return redirect()->back();
    }

    public function postDelete($username) {
        $user = User::where('username', $username)->first();


        if (! Auth::user()->isFriendWith($user)) { abort(404); }

        Auth::user()->deleteFriend($user);

        alert()->success('El usuario ha sido eliminado de tus amigos.', 'Éxito')->autoclose(3000);
        return redirect()->back();
    }

}
