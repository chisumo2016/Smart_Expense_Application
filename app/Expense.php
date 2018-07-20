<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class Expense extends Model
{
    //
    protected  $table = 'expenses';
    protected  $fillable =['user_id','company_id','budget_id','approver_id','priority','price','outside','subject',
        'description','file','status','comments'];

//  Select/fetching the columns in Query Select
    public  function  getAll()
    {
        // Creating Filters in Query
        $company_id = Auth::user()->company_id;
        $department = Input::get('department');
        $status = Input::get('status');
        $period = Input::get('period');



        $table = DB::table('expenses as e');

        //Select the field name in the database
        $table = $table->select(
            //Field required in expense table

            'e.id', 'e.price','e.outside as budget','e.priority','e.status','e.subject', 'e.description','e.comments',
            'e.approver_id as approver', 'e.company_id', 'e.created_at','e.updated_at','u.name as user', 'u.logo as logo',
            'u.email','b.item','c.name as category','p.id as period', 'app.name as approver_name','app.logo as approver_logo'
        );

        // Join Query Table -----Return the collection of array
        $table = $table->leftJoin('companies    as      cmp',       'cmp.id' ,   '=' ,   'e.company_id');
        $table = $table->leftJoin('budgets      as      b',         'b.id' ,     '=' ,   'e.budget_id');
        $table = $table->leftJoin('categories   as      c',         'c.id' ,     '=' ,   'e.category_id');
        $table = $table->leftJoin('users        as      u',         'u.id' ,     '=' ,   'e.user_id');
        $table = $table->leftJoin('users        as      app',       'app.id',    '=' ,   'e.approver_id');
        $table = $table->leftJoin('periods      as       p',        'p.id' ,     '=' ,   'e.period_id');

        //Creating filter in Query
        $table = $table->where('e.company_id', '=' ,$company_id );
        if ($department &&  $department != 'all')
        {
            $table = $table ->where('b.category_id', $department);
        }


        if ($period &&  $period != 'all')
        {
            $table = $table ->where('b.period_id', $period);
        }

        if ($status &&  $status != 'all')
        {
            $table = $table ->where('e.status', $period);
        }




        $table= $table->orderBy('created_at', 'DESC');
        //Fetching

        $table = $table->get();


        return  $table;
    }
}
