<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Category;
use App\Http\Requests\CreateBudgetRequest;
use App\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;

class BudgetsController extends Controller
{
    //Constructor
    public  function  __construct()
    {
        $this->middleware('auth');
        $this->categories = new Category();
        $this->periods = new Period();
        $this->colors = \App\Providers\Common::colors();
        $this->budgets = new Budget();
    }

    //
    public function index()
    {
        // Appy ACL
        if(Auth::user()->role == 3)
        {
            return redirect()->back()->with('error', 'Access denied you dont have enough sufficient privileges');
        }

        if(Auth::user()->company_id  == NULL )
        {
            return redirect()->route('company.index')->with('error', 'Please select / Create your company first');
        }

        //url to display all budgets

        if (Input::get('department') == false ||  Input::get('period' == false))
        {
           return redirect('/budgets?department=all&period=all');
        }

        $data['department']         = Input::get('department');
        $data['period']              = Input::get('period');


        $data['periods']        = $this->periods    ->whereUser();
        $data['categories']     = $this->categories ->whereUser();
        $data['budgets']        = $this->budgets    ->whereUser();
        $data['colors']         = $this->colors;

        //dd($data['budgets']);

         return view('budgets.index', $data);
    }

    public  function create()
    {
       $data['categories']  =   $this->categories->whereUser();
       $data['periods']     =   $this->periods->whereUser();

       return view('budgets.create',$data);

    }

    public  function  store(CreateBudgetRequest  $request)
    {
        // Appy ACL
        if(Auth::user()->role == 3)
        {
            return redirect()->back()->with('error', 'Access denied you dont have enough sufficient privileges');
        }
        $budgets =  new Budget($request->all());
        $budgets->user_id = Auth::user()->id;
        $budgets->company_id = input::get('company_id');

        $budgets->save();

        return redirect()->back()->with('message', 'Budget Recorded Created Successfully');
      //dd($request);
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
