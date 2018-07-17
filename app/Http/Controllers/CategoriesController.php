<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Appy ACL
        if( Auth::user()->role == 3)
        {
            return redirect()->back()->with('error', 'Access denied you dont have enough sufficient privileges');
        }

        $category = new Category($request->all());
        $category->save();

        return redirect()->back()->with('message','New Category Created');
    }
    public function  edit($id)
    {
        // Appy ACL
        if( Auth::user()->role == 3)
        {
            return redirect()->back()->with('error', 'Access denied you dont have enough sufficient privileges');
        }

       $data['category'] = $this->categories->where('id', $id)->first(); //dd($data['category']);

       return view('categories.edit-category',$data);

    }


    public function  update(CreateCategoryRequest $request , $id)
    {
        // Appy ACL
        if(Auth::user()->role == 3)
        {
            return redirect()->back()->with('error', 'Access denied you dont have enough sufficient privileges');
        }


       $category = $this->categories->where('id', $id)->first();
       $category->name = $request ->name;
       $category->save();

        return redirect()->route('categories-periods.index')->with('message','Category Updated Successfully');

    }

    public function  delete($id)
    {
        // Appy ACL
        if(Auth::user()->role == 2 || Auth::user()->role == 3)
        {
            return redirect()->back()->with('error', 'Access denied you dont have enough sufficient privileges');
        }


        $category = $this->categories->where('id', $id);

        $category->delete();

        return redirect()->back()->with('message','Category Deleted Successfully');
    }
}
