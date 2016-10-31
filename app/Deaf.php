<?php

namespace Coclus;

use Illuminate\Database\Eloquent\Model;

class Deaf extends Model
{
    protected $table = 'deaf';

    public function user(){
        return $this->belongsTo('Coclus\User', 'user_id');
    }

    public function communication_type() {
        return $this->hasMany('Coclus\CommunicationType', 'id', 'communication_type_id');
    }

    public function getCommunicationTypes() {
        return $this->communication_type->where('id', $this->communication_type_id);
    }


}
