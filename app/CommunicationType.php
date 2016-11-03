<?php

namespace Coclus;

use Illuminate\Database\Eloquent\Model;

class CommunicationType extends Model
{
    protected $table = "communication_type";
    protected $visible = [
        'id',
        'name',
        'speciallity_id',
        'category',
    ];

    public function deaf() {
        return $this->belongsTo('Coclus\Deaf', 'communication_type_id');
    }
}
