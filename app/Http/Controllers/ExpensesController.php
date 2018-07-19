<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Category;
use App\Expense;
use App\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


       return view ('expenses.index');
    }

    public  function create()
    {
        $data['budgets']  = $this->budgets->whereUser();
        $data['periods']  = $this->periods->whereUser();

        return view ('expenses.create', $data);
    }

    public  function  store(Request $request)
    {
        dd($request);
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
