<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    //Constructor
    public  function  __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
      return view('companies.index');
    }

    public  function create()
    {
        $data['title'] = trans('app.companies-create');
       return view('companies.create', $data);
    }

    public  function  store(Request $request)
    {
       //Validate the input
        $this->validate($request,[
            'name' => 'required|unique:companies,name,'.Auth::user()->id.'user_id',
        ]);

        //Instantiate the Company
        $company = new Company;
        $user_id = Auth::user()->id;
        $company->name    = $request -> name;
        $company->user_id = $user_id;

        //Save

        $company->save();

        return redirect()->back()->with('message','New Company Created');
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

    public function active()
    {

    }
}
