<?php

namespace App\Repositories;

use App\Models\parking;
use App\Repositories\BaseRepository;

class parkingRepository extends BaseRepository
{

    protected $fieldSearchable = [
        'id',
        'nom',
        'longeur',
        'largeur',
        'lieu'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return parking::class;
    }
}
