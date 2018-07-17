<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePeriodRequest;
use App\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodsController extends Controller
{
    //Constructor
    public  function  __construct()
    {
        $this->middleware('auth');
        $this->periods = new Period();
    }

    //
    public function index()
    {

    }

    public  function create()
    {

    }

    public  function  store(CreatePeriodRequest $request)
    {
        if(Auth::user()->role == 2 || Auth::user()->role == 3)
        {
            return redirect()->back()->with('error', 'Access denied you dont have enough sufficient privileges');
        }

       $period = new Period($request->all());
       $period->save();

       return redirect()->back()->with('message', 'New Perid created Sucessfully');
    }

    public function  edit($id)
    {
        //ACL
        if(Auth::user()->role == 2 || Auth::user()->role == 3)
        {
            return redirect()->back()->with('error', 'Access denied you dont have enough sufficient privileges');
        }


        $data['period'] =$this->periods->where('id',$id)->first();  // dd($data['period']);

        return view('periods.edit-period',$data);
    }

    public function  update(CreatePeriodRequest $request ,$id)
    {
        if(Auth::user()->role == 2 || Auth::user()->role == 3)
        {
            return redirect()->back()->with('error', 'Access denied you dont have enough sufficient privileges');
        }


        $period = $this->periods->where('id',$id)->first();
        $period->from = $request ->from;
        $period->to   = $request ->to;

        $period->save();

        return redirect()->route('categories-periods.index')->with('message','Periods Updated Successfully');

        //dd($request);
    }

    public function  delete($id)
    {
        if(Auth::user()->role == 2 || Auth::user()->role == 3)
        {
            return redirect()->back()->with('error', 'Access denied you dont have enough sufficient privileges');
        }


        $period = $this->periods->where('id',$id);
        $period->delete();
        return redirect()->back()->with('error','Periods Delete Successfully');
//       dd($id);
    }
}
