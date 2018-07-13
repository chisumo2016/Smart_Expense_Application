<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use App\Http\Requests\CreateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public  function  store(CreateUserRequest  $request)
    {
        $parent_id = Auth::user()->id;
        $data['parent_id']      =  $parent_id;
        $data['company_id']     =  $request->company_id;
        $data['country']        =  $request->country;
        $data['state']          =  $request->state;
        $data['name']           =  $request->name;
        $data['email']          =  $request->email;
        $data['password']       =  bcrypt($request->password);
        $data['phone']          =  $request->phone;
        $data['city']           =  $request->city;
        $data['address']        =  $request->address;
        $data['role']           =  $request->role;
        $data['status']         =  $request->status;
        $data['logo']           =  'logo.png';

        $users = new User($data);
        $users->save();

        
       //dd($request);
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
