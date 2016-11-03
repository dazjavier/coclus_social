<?php

namespace Coclus;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = "likeable";
    protected $visible = [
        'id',
        'user_id',
        'likeable_id',
        'likeable_type',
    ];

    public function likeable() {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo('Coclus\User', 'user_id');
    }
}
