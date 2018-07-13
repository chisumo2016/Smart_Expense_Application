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
        dd($id);
    }

    public function  update()
    {

    }

    public function  delete($id)
    {
       dd($id);
    }
}
