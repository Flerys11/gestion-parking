<?php

namespace App\Repositories;

use App\Models\vehicule;
use App\Repositories\BaseRepository;

class vehiculeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'id',
        'marque',
        'longeur',
        'largeur'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return vehicule::class;
    }
}
