<?php

namespace Coclus;

use Illuminate\Database\Eloquent\Model;

class Familiar extends Model
{
    protected $table = 'familiar';

    protected $fillable = [
        'relation',
        'step',
    ];

    public function user(){
        return $this->belongsTo('Coclus\User', 'user_id');
    }
}
