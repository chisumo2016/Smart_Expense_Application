<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesPeriodsController extends Controller
{
    //Constructor
    public  function  __construct()
    {
        $this->middleware('auth');
        $this->categories = new Category();
    }
    //
    public function index()
    {

        $data['categories'] = $this->categories->orderBy('name', 'ASC')->where('company_id',Auth::user()->company_id)->get();
        return view('categories_periods.index',$data);
    }
}
