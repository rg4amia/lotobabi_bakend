<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tirage extends Model
{
    protected $fillable = ['jour','tirage'];
    protected $casts = [
        'jour'      => 'string',
        'tirage'    => 'array'
    ];
}
