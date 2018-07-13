<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //Constructor
    public  function  __construct()
    {
        $this->middleware('auth');

        $this->categories  = new Category();
        $this->companies   = new Company();
        $this->users       = new User();
    }


    //
    public function index()
    {

    }

    public  function create()
    {
        $data['roles']       = $this->users->roles();
        $data['companies']   = $this->companies->whereUser();
        $data['categories']  = $this->categories->whereUser();

       return view('users.create', $data);
    }

    public  function  store(Request $request)
    {
       dd($request);
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
