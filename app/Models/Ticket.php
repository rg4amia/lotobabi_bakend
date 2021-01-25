<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['pions','typejeu','typejeu2','doublechance','jeujour_name','jeujour_heure','status','montantmise','gains'];

    protected $casts = [
        'pions'         => 'array',
        'typejeu'       => 'string',
        'typejeu2'      => 'string',
        'doublechance'  => 'boolean',
        'jeujour_name'  => 'string',
        'jeujour_heure' => 'string',
        'status'        => 'boolean',
        'montantmise'   => 'integer',
        'gains'   => 'integer',
    ];
}
