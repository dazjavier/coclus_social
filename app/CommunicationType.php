<?php

namespace Coclus;

use Illuminate\Database\Eloquent\Model;

class CommunicationType extends Model
{
    protected $table = "communication_type";

    public function deaf() {
        return $this->belongsTo('Coclus\Deaf', 'communication_type_id');
    }
}
