<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Category;
use App\Expense;
use App\Http\Requests\CreateExpenseRequest;
use App\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ExpensesController extends Controller
{
    //Constructor
    public  function  __construct()
    {
        $this->middleware('auth');
        $this->periods = new Period();
        $this->categories = new Category();
        $this->budgets = new Budget();
        $this->expenses = new Expense();
        $this->colors = \App\Providers\Common::colors();
    }


    //
    public function index()
    {


        if(Auth::user()->company_id  == NULL )
        {
            return redirect()->route('company.index')->with('error', 'Please select / Create your company first');
        }

        // Appy ACL
        if(Auth::user()->role == 3)
        {
            return redirect()->back()->with('error', 'Access denied you dont have enough sufficient privileges');
        }

        $data['periods']    = $this->periods->whereUser();
        $data['categories'] = $this->categories->whereUser();


       return view ('expenses.index',$data);
    }

    public  function create()
    {
        $data['budgets']  = $this->budgets->whereUser();
        $data['periods']  = $this->periods->whereUser();

        return view ('expenses.create', $data);
    }

    public  function  store(CreateExpenseRequest $request)
    {

        $budget_id = explode(":", $request->budget_id);
        //$request->budget_id   = $budget_id[0];
        $budgetID            = $budget_id[0];
        $category_id          = $budget_id[2];
        $period_id            = $budget_id[3];

        $expense = new Expense($request->all());

        $expense->category_id   = $category_id;
        $expense->period_id     = $period_id;
        $expense->budget_id     = $budgetID ;
        $expense->user_id       =  Auth::user()->id;
        $expense->company_id    =  Input::get('company_id');
        $expense->outside       =  Input::get('outside');

        //File validation  2
        if($request->file('file') && $request->file('file')->isValid())
        {
            //Define the path  1
            $destinationPath    = './uploads';
            $filename           =  time().'.'.$request->file('file')->getClientOriginalExtension();
            //Move a file to specified des
            $request->file('file')->move( $destinationPath, $filename);
            //Store a file in database
            $expense->file   =   $filename;

        }

        //Save
        $expense->save();

        return redirect()->back()->with('message', 'New Record  Inserted');













        dd($budget_id);

    }

    public  function  show()
    {
        return view ('expenses.show');
    }


    public function  edit()
    {

    }

    public function  update()
    {

    }

    public function  delete()
    {

    }
}
