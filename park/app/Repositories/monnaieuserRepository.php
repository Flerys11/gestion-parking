<?php

namespace App\Repositories;

use App\Models\monnaieuser;
use App\Repositories\BaseRepository;

class monnaieuserRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'monnaie_entre'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return monnaieuser::class;
    }
}
