<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class CountryZone extends Model
{
    //
    protected  $table = 'country_zones';

    protected  $fillable=[
        'code',
        'name',
        'country_id'
    ];

    public function  zones()
    {
        //dd(Input::get('id'));
        $country_id = Input::get('id');
        return CountryZone::where('country_id',$country_id )->get();
    }

}
