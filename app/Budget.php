<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class Budget extends Model
{
    //
    protected  $table = 'budgets';
    protected  $fillable =['user_id','company_id','category_id','period_id','item','unit','quantity','budget'];


    public  function  whereUser()
    {
        $company_id = Auth::user()->company_id;
        //url
        $department = "";
        $period     =  "";
        $AND        ="";

        if(Input::get('department') && Input::get('department')!=="all")
        {
            $department = "AND b.category_id = ". Input::get('department'). "";
        }

        if(Input::get('period') && Input::get('period')!=="all")
        {
            $period = "AND b.period_id = ". Input::get('period'). "";
        }

        return DB::select(DB::raw("
        
           SELECT
           b.id , b.item, b.unit, b.company_id, b.category_id , b.period_id, b.quantity,b.budget,b.created_at,u.name as name
           
          
           FROM budgets as b
           
            LEFT JOIN users as u ON b.user_id = u.id
            
            LEFT JOIN categories as c ON b.category_id = c.id
            
           
           WHERE b.company_id = $company_id
           
           $department
           $period
           $AND
           
           ORDER BY b.id DESC 
           
           
        
        
        "));
    }
}
