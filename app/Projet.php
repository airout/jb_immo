<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
   protected $table = 'projet';
    
        protected $fillable = [
        'id','nom', 'code', 'type', 'adresse', 'date_autorisation_construction', 'date_permis_habiter', 'prolongation_reservation', 'limite_annulation_reservation', 'propriete_dite_projet', 'titre_foncier', 'surface_terrain', 'montant_min','nbre_jour_remboursement','created_at', 'updated_at',
    ];
}
