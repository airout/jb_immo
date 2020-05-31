<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Immeuble extends Model
{
    protected $table = 'immeuble';
    
        protected $fillable = [
        'id','projet_id', 'tranche_id', 'bloc_id', 'description','titre_foncier', 'created_at', 'updated_at',
    ];
}
