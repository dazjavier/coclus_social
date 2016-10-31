<?php

namespace Coclus;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable = [
        'body',
    ];

    public function user(){
        return $this->belongsTo('Coclus\User', 'user_id');
    }

    public function scopeNotReply($query) {
        return $query->whereNull('parent_id');
    }

    public function replies() {
        return $this->hasMany('Coclus\Status', 'parent_id');
    }

    public function likes() {
        return $this->morphMany('Coclus\Like', 'likeable');
    }
}
