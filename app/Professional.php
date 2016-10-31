<?php

namespace Coclus;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Professional extends Model
{
    use Rateable;

    protected $table = "professional";

    public function user(){
        return $this->belongsTo('Coclus\User', 'user_id');
    }

    public function speciallity() {
        return $this->hasOne('Coclus\Speciallity', 'id');
    }

    public function getSpeciallity(){
        return $this->speciallity->where('id', $this->speciallity_id)->get()->first();
    }
}
