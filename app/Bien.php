<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
     protected $table = 'bien';
    
        protected $fillable = [
        'id','projet_id', 'tranche_id', 'bloc_id', 'immeuble_id', 'numero','titre_foncier', 'avance_min', 'propriete_dite_bien', 'niveau', 'etat', 'type', 'orientation', 'conventionne', 'prix', 'superficie', 'commentaire' , 'created_at', 'updated_at',
    ];
}
