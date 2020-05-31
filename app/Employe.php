<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = 'employe';

    protected $fillable = [
        'id','nom', 'prenom', 'intitule_poste', 'cin', 'cnss','date_recrutement', 'niveau_etude', 'mission', 'nb_jour_recupere' , 'created_at', 'updated_at',
    ];
}
