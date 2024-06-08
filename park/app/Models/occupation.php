<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class occupation extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'occupation';
    protected $fillable = [
        'id',
        'id_user',
        'idparking',
        'idvehicule',
        'date_debut',
        'date_fin',
        'etat'
    ];
}
