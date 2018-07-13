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
        $data['users']       = $this->users->role();
        $data['companies']   = $this->companies->whereUser();
        $data['categories']  = $this->categories->role();

       return view('users.create', $data);
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
