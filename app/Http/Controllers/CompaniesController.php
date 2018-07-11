<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function active()
    {

    }
}
