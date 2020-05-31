<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aquereur extends Model
{

    protected $table = 'aquereurs';

    protected $fillable = [
        'id','dossier_id','client_id', 'created_at', 'updated_at',
    ];
}

