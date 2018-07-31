<?php

namespace App\Http\Controllers;

use App\Category;
use App\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesPeriodsController extends Controller
{
    //Constructor
    public  function  __construct()
    {
        $this->middleware('auth');

        $this->categories = new Category();
        $this->periods =    new Period();
    }
    //
    public function index()
    {
        //dd(Auth::user());
        if (Auth::user()->company_id == NULL)
        {
            return redirect()->route('company.index')->with('error','please Create / Select your company first ');
        }

           /*Old way */
        //$data['categories'] = $this->categories->orderBy('name', 'ASC')->where('company_id',Auth::user()->company_id)->get();
        //$data['periods'] =    $this->periods->get();

        /*New way */
        $data['categories'] = $this->categories->whereUser();
        $data['periods'] =    $this->periods->whereUser();


        return view('categories_periods.index',$data);
    }
}
