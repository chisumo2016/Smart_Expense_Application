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
        $this->middleware('auth');
        $this->categories = new Category;
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
       $data['category'] = $this->categories->where('id', $id)->first(); //dd($data['category']);

       return view('categories.edit-category',$data);

    }


    public function  update(CreateCategoryRequest $request , $id)
    {
       $category = $this->categories->where('id', $id)->first();
       $category->name = $request ->name;
       $category->save();

        return redirect()->route('categories-periods.index')->with('message','Category Updated Successfully');

    }

    public function  delete($id)
    {
        dd($id);
    }
}
