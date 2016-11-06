<?php

namespace Coclus;

use Illuminate\Database\Eloquent\Model;

class Interests extends Model
{
    protected $table = "interest";

    public function user() {
        return $this->belongsTo('Coclus\User', 'user_id');
    }
}
