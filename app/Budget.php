<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Budget extends Model
{
    //
    protected  $table = 'budgets';
    protected  $fillable =['user_id','company_id','category_id','period_id','item','unit','quantity','budget'];


    public  function  whereUser()
    {
        $company_id = Auth::user()->company_id;

        return DB::select(DB::raw("
        
           SELECT
           b.id , b.item, b.unit, b.company_id, b.category_id , b.period_id, b.quantity,b.budget,b.created_at,u.name as name
           
          
           FROM budgets as b
           
            LEFT JOIN users as u ON b.user_id = u.id
            
           
           WHERE b.company_id = $company_id
           
           ORDER BY b.id DESC 
           
           
        
        
        "));
    }
}
