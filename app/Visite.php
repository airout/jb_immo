<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{

    protected $table = 'visite';

    protected $fillable = [
        'id','cc_id', 'date', 'nom', 'prenom', 'telephone', 'cin', 'source', 'partenaire_id', 'interet', 'statut', 'projet_id', 'bien_id',  'commentaire', 'mode_relance', 'derniere_relance', 'prochaine_relance', 'rdv', 'frein','created_at', 'updated_at',
    ];
}

