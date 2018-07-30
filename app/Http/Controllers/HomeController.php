<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Category;
use App\Expense;
use App\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->expenses          =      new Expense();
        $this->budgets           =      new Budget();
        $this->colors            =      \App\Providers\Common::colors();
        $this->categories        =      new Category();
        $this->periods           =      new Period();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->company_id == NULL)
        {
            return redirect()->route('company.index')->with("error", "Please Create/Select  Your company first");
        }

        //Data Array
        $data['expenses']                = $this->expenses->where('company_id', Auth::user()->company_id)->get();
        $data['categories']              = $this->categories ->whereUser();
        $data['budgets']                 = $this->budgets    ->whereUser();
        $data['colors']                  = $this->colors;
        $data['total']                   = $this->budgets->budgetExpenseTotal();
        $data['total']                   = $data['total'][0];
        $data['periods']                 = $this->periods    ->whereUser();

        $companyID = Auth::user()->company_id;
        $userID    = Auth::user()->id;

        $data['Pending']     = $this->expenses->dashboard_data($companyID,$userID, 'Pending');
        $data['Approved']    = $this->expenses->dashboard_data($companyID,$userID, 'Approved');
        $data['Denied']      = $this->expenses->dashboard_data($companyID,$userID, 'Denied');
        $data['Closed']      = $this->expenses->dashboard_data($companyID,$userID, 'Closed');

        //dd($data['Pending']);


        return view('home', $data);
    }
}
