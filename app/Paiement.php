<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{

    protected $table = 'paiement';

    protected $fillable = [
        'id','dossier_id', 'num_recu' , 'sr', 'montant', 'montant_lettre', 'date_reglement', 'modalite_paiement','echeance', 'banque', 'num_paiement', 'created_at', 'updated_at',
    ];
}

