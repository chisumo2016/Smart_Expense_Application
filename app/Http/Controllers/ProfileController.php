<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use App\User;

class ProfileController extends Controller
{
    //Constructor
    public  function  __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $dat['profile'] = Auth::user();
      return view('profile.index');
    }

    public  function create()
    {

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
