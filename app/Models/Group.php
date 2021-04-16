<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Group
 * @package App\Models
 * @version October 15, 2020, 4:59 am UTC
 *
 * @property integer $idModerador
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $schedules
 * @property string $phone
 * @property string $facebook
 * @property string $site
 * @property string $mapa
 * @property boolean $app_posts
 * @property boolean $app_finance
 * @property boolean $app_approvals
 * @property boolean $app_tasks
 * @property boolean $app_statistics
 * @property boolean $app_researches
 * @property boolean $app_degination
 * @property boolean $app_devontial
 * @property boolean $app_tip
 * @property boolean $app_bible
 * @property boolean $app_el_church
 * @property boolean $app_space
 * @property string $url_el_church
 * @property boolean $app_store
 * @property string $url_shop
 * @property string $label_media
 * @property string $description_media
 * @property string $label_calendar
 * @property string $description_calendar
 * @property string $label_download
 * @property string $description_download
 * @property string $label_application
 * @property string $label_comunication
 * @property string $contact_us
 */
class Group extends Model
{
    

    public $table = 'groups';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'idModerador' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'address' => 'string',
        'schedules' => 'string',
        'phone' => 'string',
        'facebook' => 'string',
        'site' => 'string',
        'mapa' => 'string',
        'app_posts' => 'boolean',
        'app_finance' => 'boolean',
        'app_approvals' => 'boolean',
        'app_tasks' => 'boolean',
        'app_statistics' => 'boolean',
        'app_researches' => 'boolean',
        'app_degination' => 'boolean',
        'app_devontial' => 'boolean',
        'app_tip' => 'boolean',
        'app_bible' => 'boolean',
        'app_el_church' => 'boolean',
        'app_space' => 'boolean',
        'url_el_church' => 'string',
        'app_store' => 'boolean',
        'url_shop' => 'string',
        'label_media' => 'string',
        'description_media' => 'string',
        'label_calendar' => 'string',
        'description_calendar' => 'string',
        'label_download' => 'string',
        'description_download' => 'string',
        'label_application' => 'string',
        'label_comunication' => 'string',
        'contact_us' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'idModerador' => 'required|integer',
        'name' => 'required|string|max:100',
        'description' => 'nullable|string',
        'address' => 'nullable|string|max:255',
        'schedules' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:255',
        'facebook' => 'nullable|string|max:255',
        'site' => 'nullable|string|max:255',
        'mapa' => 'nullable|string',
        'url_el_church' => 'required|string|max:255',
        'app_store' => 'required|boolean',
        'url_shop' => 'nullable|string|max:255',
        'label_media' => 'required|string|max:40',
        'description_media' => 'required|string|max:150',
        'label_calendar' => 'required|string|max:40',
        'description_calendar' => 'required|string|max:150',
        'label_download' => 'required|string|max:40',
        'description_download' => 'required|string|max:150',
        'label_application' => 'required|string|max:40',
        'label_comunication' => 'required|string|max:40',
        'contact_us' => 'required|string|max:40',
    ];

    
}
