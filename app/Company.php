<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected  $table = 'companies';
    protected  $fillable =['user_id','name'];

    //this company belongs this user  1:M

    public function  user()
    {
        return $this->belongsTo('App\User');
    }
}




