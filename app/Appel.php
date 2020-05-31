<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appel extends Model
{
    protected $table = 'appel';

    protected $fillable = [
        'id', 'date', 'nom', 'prenom', 'telephone', 'ville', 'source', 'type_bien', 'commentaire_assistance', 'cc_id', 'date_relance', 'interet', 'frein', 'prochaine_relance', 'commentaire_cc', 'traite', 'injoignable', 'created_at', 'updated_at',
    ];
}
