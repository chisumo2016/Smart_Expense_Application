<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\User;
use Illuminate\Http\Request;
use App\Company;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    //Constructor
    public  function  __construct()
    {
        $this->middleware('auth');
        $this->companies = new Company;
        $this->users = new User;
        $this->colors = \App\Providers\Common::colors();
    }

    //
    public function index()
    {
      $data['title']  = trans('app.companies-title');
      $data['colors'] = $this->colors;
      $data['users']  =  $this->users;
      $data['companies']  =  $this->companies->get();

      return view('companies.index', $data);
    }

    public  function create()
    {
        $data['title'] = trans('app.companies-create');
       return view('companies.create', $data);
    }

    public  function  store(CreateCompanyRequest $request)
    {
        $company = new Company($request->all());
        Auth::user()->companies()->save($company);
        return redirect()->back()->with('message','New Company Created');


    //       //Validate the input
    //        $this->validate($request,[
    //            'name' => 'required|unique:companies,name,'.Auth::user()->id.'user_id',
    //        ]);
    //
    //        //Instantiate the Company
    //        $company = new Company;
    //        $user_id = Auth::user()->id;
    //        $company->name    = $request -> name;
    //        $company->user_id = $user_id;
    //
    //        //Save
    //
    //        $company->save();
    //
    //        return redirect()->back()->with('message','New Company Created');
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
