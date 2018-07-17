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
        $data['users'] =  $this->users->whereUser();
       return view('users.index',$data);
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

    public function  edit($id)
    {

        //Data Array
        $data['roles']          =       $this->users->roles();
        $data['companies']      =       $this->companies->whereUser();
        $data['categories']     =       $this->categories->whereUser();
        $data['users']          =       $this->users;
        $data['user']           =       $this->users->whereUser($id);
        $data['user']           =       $data['user'][0];

        $data['id']             =       $id;

        return view('users.edit', $data);

        //dd($data['user']); //dd($id);exit();



    }

    public function  update(Request $request, $id)
    {
        $users = User::find($id);

        //validating
        if($request->input('email') == $users->email)
        {
            $this->validate($request,[
                'name'  => 'required',
                'role'  => 'required',
            ]);
        }else{
            $this->validate($request,[
                'name'  => 'required',
                'email' => 'required|unique:users',
                'role'  => 'required',
            ]);
        }

        $users->name            =  $request->name;
        $users->email           =  $request->email;
        $users->phone           =  $request->phone;
        $users->city            =  $request->city;
        $users->postal_code     =  $request->postal_code;
        $users->address         =  $request->address;
        $users->role            =  $request->role;
        $users->status          =  $request->status;

/*        $data['name']           =  $request->name;
//        $data['email']          =  $request->email;
//        $data['phone']          =  $request->phone;
//        $data['city']           =  $request->city;
//        $data['postal_code']    =  $request->postal_code;
//        $data['address']        =  $request->address;
//        $data['role']           =  $request->role;
          $data['status']         =  $request->status;*/


        $users->save();

        //exit();

        //Flushing all before updating
        User_Detail::where('user_id', $id)->delete();

        if(count($request->access) > 0)  // create form
        {
            //Access the id of new created user details
            $user_id = $users->id;
            foreach ($request->access as $companyId => $category )
            {
                // $key => $value

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

        return redirect()->route('user.index')->with('message', 'New Record Update');
        //dd($request);
        //dd($users);
    }

    public function  delete()
    {

    }
}
