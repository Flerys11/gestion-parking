<?php

namespace App\Repositories;

use App\Models\tarif;
use App\Repositories\BaseRepository;

class tarifRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'heure',
        'prix'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return tarif::class;
    }
}
