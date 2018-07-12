<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //Constructor
    public  function  __construct()
    {
        //$this->middleware('auth');
    }

    //
    public function index()
    {

    }

    public  function create()
    {

    }

    public  function  store(CreateCategoryRequest $request)
    {
      //dd($request);
        $category = new Category($request->all());
        $category->save();

        return redirect()->back()->with('message','New Category Created');
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
