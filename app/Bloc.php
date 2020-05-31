<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloc extends Model
{
    protected $table = 'bloc';
    
        protected $fillable = [
        'id','projet_id', 'tranche_id', 'description','titre_foncier', 'created_at', 'updated_at',
    ];
}
