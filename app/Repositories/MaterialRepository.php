<?php

namespace App\Repositories;

use App\Models\Material;
use App\Repositories\BaseRepository;

/**
 * Class MaterialRepository
 * @package App\Repositories
 * @version December 29, 2020, 9:26 am UTC
*/

class MaterialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'material',
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
        return Material::class;
    }
}
