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
    public  function  getAll($id = NULL)
    {
        // Creating Filters in Query
        $company_id = Auth::user()->company_id;
        $department = Input::get('department');
        $status = Input::get('status');
        $period = Input::get('period');

        //Search
        $search = Input::get('search');



        $table = DB::table('expenses as e');

        //Select the field name in the database
        $table = $table->select(
            //Field required in expense table

            'e.id', 'e.price','e.outside as budget','e.priority','e.status','e.subject', 'e.description','e.comments',
            'e.approver_id as approver', 'e.company_id', 'e.created_at','e.updated_at','e.file','u.name as user', 'u.logo as logo',
            'u.email','b.item','c.name as category','p.id as period', 'app.name as approver_name','app.logo as approver_logo'
        );

        // Join Query Table -----Return the collection of array
        $table = $table->leftJoin('companies    as      cmp',       'cmp.id' ,   '=' ,   'e.company_id');
        $table = $table->leftJoin('budgets      as      b',         'b.id' ,     '=' ,   'e.budget_id');
        $table = $table->leftJoin('categories   as      c',         'c.id' ,     '=' ,   'e.category_id');
        $table = $table->leftJoin('users        as      u',         'u.id' ,     '=' ,   'e.user_id');
        $table = $table->leftJoin('users        as      app',       'app.id',    '=' ,   'e.approver_id');
        $table = $table->leftJoin('periods      as       p',        'p.id' ,     '=' ,   'e.period_id');


        //sTTING QUERY  SHOW AS SINGLE EXPENSE

        if ($id == NULL)
        {
            //Creating filter in Query
        $table = $table->where('e.company_id', '=' ,$company_id );

        // Appplying ACL
        if (Auth::user()->role !=1 )
        {
            $table = $table->whereIn('e.category_id', $this->user_details());
        }

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

        //Search
        if($search)
        {
            $table = $table->where('e.id', 'like', $search);
            $table = $table->orWhere('u.name',      'like', '%'.$search.'%');
            $table = $table->orWhere('b.item',      'like', '%'.$search.'%');
            $table = $table->orWhere('e.price',     'like', '%'.$search.'%');
            $table = $table->orWhere('c.name',       'like', '%'.$search.'%');
            $table = $table->orWhere('e.status',     'like', '%'.$search.'%');
            $table = $table->orWhere('e.outside',    'like', '%'.$search.'%');
            $table = $table->orWhere('e.created_at', 'like', '%'.$search.'%');
        }




        $table= $table->orderBy('created_at', 'DESC');

        //Fetching    $table = $table->get();

            //Pagnation
            $table = $table->paginate(2);



        return  $table;

        }else{

            //ID  is given get record
            $table = $table->where('e.id',$id);
            return $table->get();

        }
//        //Creating filter in Query
//        $table = $table->where('e.company_id', '=' ,$company_id );
//
//        // Appplying ACL
//        if (Auth::user()->role !=1 )
//        {
//            $table = $table->whereIn('e.category_id', $this->user_details());
//        }
//
//        if ($department &&  $department != 'all')
//        {
//            $table = $table ->where('b.category_id', $department);
//        }
//
//
//        if ($period &&  $period != 'all')
//        {
//            $table = $table ->where('b.period_id', $period);
//        }
//
//        if ($status &&  $status != 'all')
//        {
//            $table = $table ->where('e.status', $period);
//        }
//
//
//
//
//        $table= $table->orderBy('created_at', 'DESC');
//        //Fetching
//
//        $table = $table->get();
//
//
//        return  $table;
    }

    public function user_details()
    {
        $company_id  = Auth::user()->company_id;
        $user_id     = Auth::user()->id;

        $table  =   DB::table('user_details');
        $table  =   $table->select('category_id'); // from user_details
        $table  =   $table->where('company_id', $company_id);
        $table  =   $table->where('user_id', $user_id);

        $result = $table->get();

        //Empty array -inject user_details
        $array =[];
        if (count($result) > 0) :
            foreach ($result as $row) :
                //store into array
                $array[] = $row->category_id;

            endforeach;

        endif;
             //Return the array

         return $array;


    }

    public function  categoryexpense()
    {
        $company_id =  Auth::user()->company_id;
        $user_id   = Auth::user()->id;

        return DB::select(DB::raw("

          SELECT  b.id , e.company_id, SUM(e.price) as expenseTotal, b.category_id as category_id
          
          FROM  budgets as b
          
          LEFT JOIN  expenses as e ON e.budget_id  = b.id
          
          WHERE  e.company_id = $company_id
          
          AND     b.user_id  =  $user_id   /* COMMENT IF U WANT A MANAGER TO CREATE  */
          
          GROUP BY   e.budget_id
        "));
    }


     /* Dashboard */

  public function  dashboard_data($user_id , $company_id , $status)
  {
      $table  = DB::table('expenses');
      $table->select('*');
      $table->where('user_id',       $user_id);
      $table->where('company_id',    $company_id);
      $table->where('status',        $status);

      //count
      $result = $table->count();
      return $result;
  }
}











