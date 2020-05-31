<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tranche extends Model
{
    protected $table = 'tranche';
    
        protected $fillable = [
        'id','projet_id', 'description', 'niveau_etages','date_livraison', 'created_at', 'updated_at',
    ];
}
