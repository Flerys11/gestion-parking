<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class parking extends Model
{
    public $table = 'parking';
    public $primaryKey = 'id';

    public $keyType = 'string';

    public $timestamps = false;
    public $fillable = [
        'id',
        'nom',
        'longeur',
        'largeur',
        'lieu'
    ];

    protected $casts = [
        'id' => 'string',
        'nom' => 'string',
        'longeur' => 'float',
        'largeur' => 'float',
        'lieu' => 'string'
    ];

    public static array $rules = [
        'nom' => 'required|max:250',
        'longeur' => 'required|max:100',
        'largeur' => 'required|max:100',
        'lieu' => 'required|max:250'
    ];

    public static function getId()
    {
        return DB::select("select park_id()")[0]->park_id;
    }
}
