<?php

namespace App\Repositories;

use App\Models\Approval;
use App\Repositories\BaseRepository;

/**
 * Class ApprovalRepository
 * @package App\Repositories
 * @version January 1, 2021, 6:01 am UTC
*/

class ApprovalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'events',
        'reason',
        'space_manager',
        'total_people',
        'location',
        'location_requester',
        'price',
        'initial_date',
        'initial_time',
        'final_date',
        'final_time',
        'space',
        'group_id',
        'status',
        'is_draft',
        'is_repproved'
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
        return Approval::class;
    }
}
