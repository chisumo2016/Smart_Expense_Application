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

        //Uptimizing Category Mode
        $AND = "";
        if(Auth::user()->role != 1)
        {

            $AND = "
                    AND cat.id IN (
                    
                       SELECT ud.category_id
                       FROM  user_details as ud
                       WHERE  ud.user_id   = ".Auth::user()->id." 
                    )
                
                ";
        }


        return DB::select(DB::raw("

         SELECT cat.id , cat.company_id, cat.name , cat.created_at,  cat.updated_at, b.budgets, b.budgetTotal
         
         FROM  categories as cat
         
         /* Query to show No Of  Budget */
         
         LEFT JOIN 
         (
         /* Query to show No Of  Budget Total */
           SELECT    count(b.id) as budgets, b.company_id, b.category_id,SUM(b.budget) as budgetTotal
           FROM      budgets as b
           WHERE     b.company_id  =   $company_id
           GROUP BY  b.category_id 
         
         ) b ON b.category_id     =  cat.id
        
        WHERE  cat.company_id     =  $company_id
        
        $AND
        
        GROUP  By cat.id
        ORDER  by cat.name ASC 
        
        "));
    }
}

//--GROUP  By cat.id