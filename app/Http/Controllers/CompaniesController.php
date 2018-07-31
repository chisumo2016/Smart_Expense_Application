<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\User;
use Illuminate\Http\Request;
use App\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CompaniesController extends Controller
{
    //Constructor
    public  function  __construct()
    {
        $this->middleware('auth');
        $this->companies    = new Company;
        $this->users        = new User;
        $this->colors       = \App\Providers\Common::colors();
    }

    //
    public function index()
    {
      $data['title']        =   trans('app.companies-title');
      $data['colors']       =   $this->colors;
      $data['users']        =   $this->users;
      $data['companies']    =   $this->companies->whereUser();  //Refining the company Mode;
      //$data['companies']  =  $this->companies->where('user_id', Auth::user()->id)->get();  //$data['companies']  =  $this->companies->get();


      return view('companies.index', $data);
    }

    public  function create()
    {
        // Appy ACL
        if(Auth::user()->role == 2 || Auth::user()->role == 3)
        {
            return redirect()->back()->with('error', 'Access denied you dont have enough sufficient privileges');
        }

        $data['title'] = trans('app.companies-create');
        return view('companies.create', $data);
    }

    public  function  store(CreateCompanyRequest $request)
    {
        // Appy ACL
        if(Auth::user()->role == 2 || Auth::user()->role == 3)
        {
            return redirect()->back()->with('error', 'Access denied you dont have enough sufficient privileges');
        }

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

    public function active() //$companyid
    {
        $user_id            =   Auth::user()->id;
        $company            =   Input::get('company');
        $company_id         =   base64_decode(urldecode($company));
        $company_name       =   $this->companies->find($company_id);

        $users = $this->users->find($user_id);

        $users->company_id   = $company_id;
        $users->company_name = $company_name->name;
        $users->save();

        return redirect()->route('company.index')->with('message','New Company' . $company_name->name .  'Selected');

        //dd($users);


        //dd($company_id);
    }
}
