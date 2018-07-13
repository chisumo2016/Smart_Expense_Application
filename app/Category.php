<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    //
    protected  $table = 'categories';
    protected  $fillable =['user_id','company_id','name'];

    //Refining Mode
    public static function  whereUser( $company_id = NULL)
    {
        $company_id = ($company_id == NULL ? Auth::user()->company_id : $company_id);

        return DB::select(DB::raw("

         SELECT cat.id , cat.company_id, cat.name , cat.created_at, cat.updated_at
         
         FROM  categories as cat
        
        WHERE  cat.company_id = $company_id
        
        ORDER  by cat.name ASC 
        
        "));
    }
}

//--GROUP  By cat.id