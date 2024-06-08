<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class histoSortie extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'historique_sortie';
    public $fillable = [
        'date_sortie',
        'prix_simple',
        'amende',
    ];
}
