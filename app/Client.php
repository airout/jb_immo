<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';

    protected $fillable = [
        'id','nom', 'prenom', 'telephone1', 'telephone2', 'civilite','adresse', 'ville', 'pays', 'profession', 'situation_pro', 'societe_id', 'cin', 'lieu_naissance', 'date_naissance','age','nationalite','nom_responsable','relation_familiale','situation_familiale','nom_mari','date_mariage','lieu_mariage','nom_pere','nom_mere','mode_financement','banque','created_at', 'updated_at',
    ];
}

