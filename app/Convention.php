<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convention extends Model
{

    protected $table = 'convention';

    protected $fillable = [
        'id','societe','created_at', 'updated_at',
    ];
}

