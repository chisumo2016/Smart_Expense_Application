<?php

namespace App\Http\Controllers;

use App\Category;
use App\Period;
use Illuminate\Http\Request;

class BudgetsController extends Controller
{
    //Constructor
    public  function  __construct()
    {
        $this->middleware('auth');
        $this->categories = new Category();
        $this->periods = new Period();
        $this->colors = \App\Providers\Common::colors();
    }

    //
    public function index()
    {

    }

    public  function create()
    {
       $data['categories']  =   $this->categories->whereUser();
       $data['periods']     =   $this->periods->whereUser();

       return view('budgets.create',$data);

    }

    public  function  store()
    {

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
