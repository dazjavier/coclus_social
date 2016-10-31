<?php

namespace Coclus;

use Illuminate\Database\Eloquent\Model;

class Speciallity extends Model
{
    protected $table = "speciallity";

    public function professional() {
        $this->belongsTo('Coclus\Professional', 'speciallity_id');
    }
}
