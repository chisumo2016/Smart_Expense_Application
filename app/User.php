<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
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

    public function  whereUser($id = NULL)
    {
        $parent_id = Auth::user()->parent_id;

        if(Auth::user()->parent_id == 0)
        {
            $parent_id = Auth::user()->id;

        }
        $table = DB::table('users as u');
        $table->where('u.parent_id', $parent_id);

        if ($id != NULL)
        {
            $table->where('id', $id);
        }

        if ($id ==  NULL)
        {
         $table->select('u.id', 'u.name','u.email', 'u.phone', 'u.status', 'r.name as role');
         $table->leftJoin('roles as r', 'u.role', '=', 'r.id');
        }

        return $table->get();

    }


}
