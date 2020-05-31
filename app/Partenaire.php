<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PArtenaire extends Model
{

    protected $table = 'partenaire';

    protected $fillable = [
        'id','nom','created_at', 'updated_at',
    ];
}

