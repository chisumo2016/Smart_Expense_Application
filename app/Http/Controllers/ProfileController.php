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
        $data['profile'] = Auth::user();
      return view('profile.index', $data);
    }

    public  function create()
    {

    }

    public  function  store()
    {

    }

    public function  edit(Request $request, $id)
    {
        //Find the User
        $user = Auth::user();
        $edit = User::find($user->id);  //Auth::find($id);

        //Validate
        $this->validate($request,[
           'name'  => 'required',
            'phone' =>'required|numeric',
            'city' =>'required',
            'country' =>'required',
            'address' =>'required',
            'logo' =>'required',
        ]);

        //Validate the image
        if ($request->file('logo') && $request->file('logo')->isValid())
        {
            if ($user->logo != "")  // Check in the logo in database
            {
                if (file_exists(public_path('./images/'.$user->logo)))
                {
                    //Delete
                    unlink(public_path('.images/'.$user->logo));
                }
            }
            //Make new file name destination .
            $destinationPath = './images/';
            $filename = time().'.'.$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move($destinationPath, $filename);


            $edit->logo = $filename;
        }

        $edit->name          =  $request->name;
        $edit->phone         =  $request->phone;
        $edit->address       =  $request->address;
        $edit->postal_code   =  $request->postal_code;
        $edit->city          =  $request->city;
        $edit->country       =  $request->country ;


        $edit->save();

        return redirect()->back()->with('message', 'User Record Updated');

    }

    public function  update(Request $request, $id)
    {
        //Find the current logged in
        $user = Auth::user();

        $edit = User::find($user->id);

        //Validate the request

        $this->validate($request,[
           'password'                => 'required|min:6',
           'password_confirmation'   => 'required|min:6'
        ]);

        $password   = $request->password;
        $c_password = $request->password_confirmation;

        //Check the password and c_password are equal

        if ($password != $c_password)
        {
            return redirect()->back()->with('error', 'Your Password does not match');
        }

        //Hashing the password
        $edit->password = bcrypt($password);

        //Save

        $edit->save();

        return redirect()->back()->with('message', 'Password Update');


    }

    public function  delete()
    {

    }
}
