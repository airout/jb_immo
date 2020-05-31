<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frein extends Model
{

    protected $table = 'frein';

    protected $fillable = [
        'id', 'visite_id', 'type_frein', 'projet_id' ,'tranche_id', 'etage', 'orientation', 'avance','prix_min', 'prix_max', 'superficie_min', 'superficie_max', 'created_at', 'updated_at',
    ];
}

