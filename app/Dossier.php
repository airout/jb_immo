<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{

    protected $table = 'dossier_reservation';

    protected $fillable = [
        'id','responsable_dossier', 'projet_id' ,'tranche_id', 'bloc_id', 'immeuble_id', 'bien_id','prix', 'date_reservation', 'date_limite_reservation', 'nombre_aquereurs', 'created_at', 'updated_at',
    ];
}

