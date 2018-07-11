<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    //
    protected  $table = 'periods';
    protected  $fillable =['user_id','company_id','from','to'];
}
