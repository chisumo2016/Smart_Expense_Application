<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePeriodRequest;
use App\Period;
use Illuminate\Http\Request;

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
       $period = new Period($request->all());
       $period->save();

       return redirect()->back()->with('message', 'New Perid created Sucessfully');
    }

    public function  edit($id)
    {
        $data['period'] =$this->periods->where('id',$id)->first();  // dd($data['period']);

        return view('periods.edit-period',$data);
    }

    public function  update(Request $request ,$id)
    {
        dd($request);
    }

    public function  delete($id)
    {
       dd($id);
    }
}
