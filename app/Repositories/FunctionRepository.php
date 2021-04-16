<?php

namespace App\Repositories;

use App\Models\Functionn;
use App\Repositories\BaseRepository;

/**
 * Class FunctionRepository
 * @package App\Repositories
 * @version December 29, 2020, 10:39 am UTC
*/

class FunctionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'professional',
        'quantity'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Functionn::class;
    }
}
