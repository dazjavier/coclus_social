<?php

namespace Coclus\Http\Controllers;

use Coclus\Like;
use Illuminate\Http\Request;
use Auth;
use Coclus\Status;
use Coclus\Http\Requests;

class StatusController extends Controller
{
    public function postStatus(Request $request) {
        $this->validate($request, [
            'status' => 'required|max:1000',
        ]);

        Auth::user()->statuses()->create([
            'body' => $request->input('status'),
        ]);

        alert()->success('El estado ha sido publicado con éxito', 'Éxito')->autoclose(3000);
        return redirect('/timeline');
    }

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

        $url = "#comment_" . $statusId;
        $reply = Status::create([
            'body' => $request->input("reply-{$statusId}"),
        ])->user()->associate(Auth::user());

        $status->replies()->save($reply);

        return back();
    }

    public function getLike($statusId){
        $status = Status::find($statusId);

        if (! $status) { return back(); }
        if (! Auth::user()->isFriendWith($status->user)) { return back(); }
        if (Auth::user()->hasLikedStatus($status)) {  return back(); }

        $like = $status->likes()->create([]);

        Auth::user()->likes()->save($like);

        return redirect()->back();
    }

    public function getUnlike($statusId) {
        $status = Like::where('likeable_id', $statusId)->delete();
        return back();
    }
}
