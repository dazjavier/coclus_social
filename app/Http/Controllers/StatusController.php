<?php

namespace Coclus\Http\Controllers;

use Auth;
use Coclus\Http\Requests;
use Coclus\Like;
use Coclus\Status;
use Coclus\User;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /*
     * Create a new User status
     */
    public function postStatus(Request $request) {
        $this->validate($request, [
            'status' => 'required|max:1000',
        ]);

        Auth::user()->statuses()->create([
            'body' => $request->input('status'),
        ]);

        alert()->success('El estado ha sido publicado con éxito', 'Éxito')->autoclose(1000);
        return redirect('/timeline');
    }

    /*
     * Delete a User status
     */
    public function deleteStatus($statusId) {
        $status = Auth::user()->statuses->find($statusId);
        if (! $status) { return back(); }
        if ($status->user->id !== Auth::user()->id) { return back(); }
        Auth::user()->statuses->find($status->id)->delete();
        return back();
    }

    /*
     * Create a new Reply for an Status
     */
    public function postReply(Request $request, $statusId) {
        $this->validate($request, [
            "reply-{$statusId}" => 'required|max:1000',
        ], [
            'required' => 'El campo comentario es requerido.',
        ]);

        $status = Status::notReply()->find($statusId);

        if (! $status) {
            alert()->error('Al parecer el estado que intentas acceder, no existe.', 'Error')->autoclose(3000);
            return redirect('/timeline');
        }

        if (! Auth::user()->isFriendWith($status->user) && Auth::user()->id !== $status->user->id) {
            alert()->error('No puedes comentar este estado.', 'Error')->autoclose(3000);
            return redirect('/timeline');
        }

        $reply = Status::create([
            'body' => $request->input("reply-{$statusId}"),
        ])->user()->associate(Auth::user());

        $status->replies()->save($reply);

        return back();
    }

    /*
     * Create a Like for an User Status
     */
    public function getLike($statusId){
        $status = Status::find($statusId);

        if (! $status) { return back(); }
        if (! Auth::user()->isFriendWith($status->user)) { return back(); }
        if (Auth::user()->hasLikedStatus($status)) {  return back(); }

        $like = $status->likes()->create([]);

        Auth::user()->likes()->save($like);

        return back();
    }

    /*
     * Delete a Like for an User Status
     */
    public function getUnlike($statusId) {
        $status = Status::find($statusId);

        if (! $status) { return back(); }
        if (! Auth::user()->isFriendWith($status->user)) { return back(); }
        if (! Auth::user()->hasLikedStatus($status)) {  return back(); }

        $status->likes()->delete($statusId);
        return back();
    }
}
