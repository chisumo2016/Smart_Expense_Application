<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use App\Http\Requests\CreateUserRequest;
use App\User;
use App\User_Detail;
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
       return view('users.index');
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
        $data['postal_code']    =  $request->postal_code;
        $data['address']        =  $request->address;
        $data['role']           =  $request->role;
        $data['status']         =  $request->status;
        $data['logo']           =  'logo.png';

        $users = new User($data);
        $users->save();

        if(count($request->access) > 0)  // create form
        {
            //Access the id of new created user details
            $user_id = $users->id;
            foreach ($request->access as $companyId => $category )
            {// $KEY => $VALUE
                if(count($category) >  0)
                {
                    foreach ($category as $cat)
                    {
                        $userDetail['user_id']          = $user_id;
                        $userDetail['company_id']       = $companyId;
                        $userDetail['category_id']      = $cat;

                        $user_detail = new User_Detail($userDetail);
                        $user_detail->save();


                    }
                }
                //dd($request);
            }


        }

        return redirect()->route('user.index')->with('message', 'New Record Inserted');
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
