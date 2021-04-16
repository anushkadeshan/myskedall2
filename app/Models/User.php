<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @version October 11, 2020, 2:42 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $userApps
 * @property integer $primary_group_id
 * @property string $name
 * @property string $nickname
 * @property string $email
 * @property string|\Carbon\Carbon $email_verified_at
 * @property string $password
 * @property boolean $sex
 * @property string $birth
 * @property string $phone
 * @property string $address
 * @property string $zipcode
 * @property string $neighborhood
 * @property string $city
 * @property string $uf
 * @property string $profession
 * @property string $rg
 * @property string $cpf
 * @property boolean $level
 * @property boolean $status
 * @property boolean $have_warning
 * @property boolean $have_group_warning
 * @property string $created_at_ip
 * @property string $last_logging_ip
 * @property string $inclusion_date
 * @property string $last_logging_at
 * @property string $remember_token
 */
class User extends Model
{

    use HasRoles;
    protected $guard_name = 'web';
    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'primary_group_id',
        'name',
        'nickname',
        'email',
        'email_verified_at',
        'password',
        'sex',
        'birth',
        'phone',
        'address',
        'zipcode',
        'neighborhood',
        'city',
        'uf',
        'profession',
        'rg',
        'cpf',
        'level',
        'status',
        'have_warning',
        'have_group_warning',
        'created_at_ip',
        'last_logging_ip',
        'inclusion_date',
        'last_logging_at',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'primary_group_id' => 'integer',
        'name' => 'string',
        'nickname' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'sex' => 'boolean',
        'birth' => 'string',
        'phone' => 'string',
        'address' => 'string',
        'zipcode' => 'string',
        'neighborhood' => 'string',
        'city' => 'string',
        'uf' => 'string',
        'profession' => 'string',
        'rg' => 'string',
        'cpf' => 'string',
        'level' => 'boolean',
        'status' => 'boolean',
        'have_warning' => 'boolean',
        'have_group_warning' => 'boolean',
        'created_at_ip' => 'string',
        'last_logging_ip' => 'string',
        'inclusion_date' => 'string',
        'last_logging_at' => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'primary_group_id' => 'integer',
        'name' => 'required|string|max:255',
        'nickname' => 'nullable|string|max:50',
        'email' => 'required|string|max:255|unique:users|email',
        'email_verified_at' => 'nullable',
        'password' => 'required|string|max:255',
        'sex' => 'nullable',
        'birth' => 'nullable|string|max:20',
        'phone' => 'nullable|string|max:50',
        'address' => 'nullable|string|max:255',
        'zipcode' => 'nullable|string|max:15',
        'neighborhood' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'uf' => 'nullable|string|max:10',
        'profession' => 'nullable|string|max:255',
        'rg' => 'nullable|string|max:30',
        'cpf' => 'nullable|string|max:30',
        'level' => 'required|boolean',
        'status' => 'required|boolean',
        'have_warning' => 'required|boolean',
        'have_group_warning' => 'required|boolean',
        'created_at_ip' => 'nullable|string|max:255',
        'last_logging_ip' => 'nullable|string|max:255',
        'inclusion_date' => 'nullable|string|max:255',
        'last_logging_at' => 'nullable|string|max:255',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public static $rules_update = [
        'name' => 'required|string|max:255',
        'nickname' => 'nullable|string|max:50',
        'email_verified_at' => 'nullable',
        'sex' => 'nullable',
        'birth' => 'nullable|string|max:20',
        'phone' => 'nullable|string|max:50',
        'address' => 'nullable|string|max:255',
        'zipcode' => 'nullable|string|max:15',
        'neighborhood' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'uf' => 'nullable|string|max:10',
        'profession' => 'nullable|string|max:255',
        'rg' => 'nullable|string|max:30',
        'cpf' => 'nullable|string|max:30',
        'level' => 'required|boolean',
        'status' => 'required|boolean',
        'have_warning' => 'required|boolean',
        'have_group_warning' => 'required|boolean',
        'created_at_ip' => 'nullable|string|max:255',
        'last_logging_ip' => 'nullable|string|max:255',
        'inclusion_date' => 'nullable|string|max:255',
        'last_logging_at' => 'nullable|string|max:255',
        'remember_token' => 'nullable|string|max:100',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function userApps()
    {
        return $this->hasMany(\App\Models\UserApp::class, 'user_id');
    }
}
