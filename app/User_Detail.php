<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Detail extends Model
{
    //
    protected  $table = 'user_details';
    protected  $fillable =['user_id','company_id','category_id'];
}
