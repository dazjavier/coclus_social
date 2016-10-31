<?php

namespace Coclus;

use Coclus\Status;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'username', 'lastname', 'comuna', 'profile_type',
    ];


    /**
     * The attributtes that are visible
     *
     * @var array
     */
    protected $visible = [
        'id', 'name', 'email', 'address', 'username', 'lastname', 'comuna', 'profile_type', 'avatar'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');


    public function getFullName() {
        return ucfirst($this->name) . ' ' . ucfirst($this->lastname);
    }

    public function getUsername() {
        return strtolower($this->username);
    }

    public function getAvatarUrl() {
        return "/uploads/avatars/" . $this->avatar;
    }

    public function getUsernameUrl() {
        return "users/" . $this->getUsername();
    }

    public function statuses() {
        return $this->hasMany('Coclus\Status', 'user_id');
    }

    public function likes() {
        return $this->hasMany('Coclus\Like', 'user_id');
    }

    public function friendsOfMine() {
        return $this->belongsToMany('Coclus\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf() {
        return $this->belongsToMany('Coclus\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends() {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests() {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending() {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user) {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user) {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user) {
        return $this->friendOf()->attach($user->id);
    }

    public function deleteFriend(User $user) {
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user) {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([ 'accepted' => true ]);
    }

    public function isFriendWith(User $user) {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function hasLikedStatus(Status $status) {
        return (bool) $status->likes->where('user_id', $this->id)->count();
    }
}
