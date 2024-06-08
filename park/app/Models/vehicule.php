<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vehicule extends Model
{
    public $table = 'vehicule';
    public $timestamps = false;
    public $fillable = [
        'id',
        'marque',
        'longeur',
        'largeur'
    ];

    protected $casts = [
        'id' => 'string',
        'marque' => 'string',
        'longeur' => 'float',
        'largeur' => 'float'
    ];

    public static array $rules = [
        'id' => 'required|max:10',
        'marque' => 'required|max:100'
    ];


}
