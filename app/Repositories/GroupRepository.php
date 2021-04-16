<?php

namespace App\Repositories;

use App\Models\Group;
use App\Repositories\BaseRepository;

/**
 * Class GroupRepository
 * @package App\Repositories
 * @version October 15, 2020, 4:59 am UTC
*/

class GroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idModerador',
        'name',
        'description',
        'address',
        'schedules',
        'phone',
        'facebook',
        'site',
        'mapa',
        'app_posts',
        'app_finance',
        'app_approvals',
        'app_tasks',
        'app_statistics',
        'app_researches',
        'app_degination',
        'app_devontial',
        'app_tip',
        'app_bible',
        'app_el_church',
        'app_space',
        'url_el_church',
        'app_store',
        'url_shop',
        'label_media',
        'description_media',
        'label_calendar',
        'description_calendar',
        'label_download',
        'description_download',
        'label_application',
        'label_comunication',
        'contact_us'
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
        return Group::class;
    }
}
