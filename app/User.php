<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'country',
        'state',
        'city',
        'address',
        'postal_code',
        'logo',
        'status',
        'company_id',
        'company_name',
        'role',
        'access',
        'parent_id'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //user has many company
    public function  companies()
    {
        return $this->hasMany('App\Company');
    }

    /*ACL*/
    public  function  roles()
    {
        return DB::table('roles')->get();
    }


}
