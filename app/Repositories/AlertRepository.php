<?php

namespace App\Repositories;

use App\Models\Alert;
use App\Repositories\BaseRepository;

/**
 * Class AlertRepository
 * @package App\Repositories
 * @version December 18, 2020, 6:10 am UTC
*/

class AlertRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'model_id',
        'event_name',
        'group_id',
        'routine',
        'is_read',
        'url',
        'updated_by',
        'deleted_by',
        'notify_to'
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
        return Alert::class;
    }
}
