<?php

namespace Coclus;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = "likeable";

    public function likeable() {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo('Coclus\User', 'user_id');
    }
}
