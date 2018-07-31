@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-8 ">
                <h2>Profile</h2>
            </div>
                <div class="col-sm-4" style="margin-top: 22px;">

                    <a href="{{ route('home') }}">
                        <button class="btn btn-primary btn-block">Dashboard &nbsp; <i class="fa fa-arrow-circle-left"></i></button>
                    </a>
                </div>

        </div>
    </div>

    <hr>

   <div class="row">
       <div class="col-sm-8 col-sm-offset-2">
           <div class="panel panel-primary">
               <div class="panel-heading">Edit Profile</div>
               <div class="panel-body">

                   <form class="form-horizontal" method="POST" action="{{ route('profile.edit', $profile->id) }}" enctype="multipart/form-data">
                       {{ csrf_field()  }}
                       
                       <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                           <label for="name" class="col-sm-4  control-label">Name:</label>

                           <div class="col-sm-6">
                               <input id="name" type="text" class="form-control" name="name" value="{{ $profile->name }}" >

                               @if ($errors->has('name'))
                                   <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                </span>
                               @endif
                           </div>
                       </div>

                       <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                           <label for="email" class=" col-sm-4 control-label">'E-Mail Address</label>

                           <div class="col-sm-6">
                               <input id="email" type="email" class="form-control" name="email" value="{{ $profile->email }}" required disabled="disabled" >

                               @if ($errors->has('email'))
                                   <span class="help-block" role="alert">
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </span>
                               @endif
                           </div>
                       </div>


                       <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                           <label for="phone" class=" col-sm-4 control-label">Phone</label>

                           <div class="col-sm-6">
                               <input id="phone" type="text" class="form-control" name="phone"  value="{{ $profile->phone }}">

                               @if ($errors->has('phone'))
                                   <span class="help-block" role="alert">
                                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                </span>
                               @endif
                           </div>
                       </div>

                       <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                           <label for="address" class="col-sm-4 control-label">Address</label>

                           <div class="col-sm-6">
                               <input type="text" class="form-control" name="address" id="address" value="{{ $profile->address }}" placeholder="Address" autofocus>
                               @if ($errors->has('address'))
                                   <span class="help-block" >
                                    <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                </span>
                               @endif
                           </div>
                       </div>


                       <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                           <label for="city" class="col-sm-4 control-label">City</label>

                           <div class="col-sm-6">
                               <input type="text" class="form-control" name="city" id="city" value="{{ $profile->city }}" placeholder="City" autofocus>
                               @if ($errors->has('city'))
                                   <span class="help-block" >
                                    <strong class="text-danger">{{ $errors->first('state') }}</strong>
                                </span>
                               @endif
                           </div>
                       </div>

                       <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
                           <label for="city" class="col-sm-4 control-label">Postal Code</label>

                           <div class="col-sm-6">
                               <input type="text" class="form-control" name="postal_code" id="postal_code" value="{{ $profile->postal_code }}" placeholder="Postal Code" autofocus>

                               @if ($errors->has('postal_code'))
                                   <span class="help-block" >
                                    <strong class="text-danger">{{ $errors->first('postal_code') }}</strong>
                                </span>
                               @endif
                           </div>
                       </div>



                       <div class="form-group">
                           <label for="country" class="control-label col-sm-4">Country</label>
                           <div class="col-sm-6">
                               <select class="form-control" name="country" id="country" onchange="get_zones($(this).val())">
                                   <option value="#">Choose Country</option>
                                   <?php
                                   $countries = DB::select(DB::raw('select * from countries')) ;
                                   ?>
                                   @if(count($countries) > 0 )
                                       @foreach($countries as $country)
                                           <option value="{{ $country->id }}">{{ $country->name }}</option>
                                       @endforeach
                                   @endif

                               </select>

                               @if ($errors->has('country'))
                                   <span class="help-block" >
                                    <strong class="text-danger">{{ $errors->first('country') }}</strong>
                                </span>
                               @endif
                           </div>
                       </div>

                       {{--<div class="form-group">--}}
                           {{--<label for="state" class="col-sm-4 control-label">State</label>--}}

                           {{--<div class="col-sm-6">--}}
                               {{--<select class="form-control" name="state" id="state">--}}

                                   {{--<option value="">Choose State 1</option>--}}

                               {{--</select>--}}

                               {{--<img src="{{ asset('images/spinner.gif') }}" id="loader" style="position: absolute; right:-9px; top:9px; display: none">--}}
                               {{--@if ($errors->has('state'))--}}
                                   {{--<span class="help-block" >--}}
                                    {{--<strong class="text-danger">{{ $errors->first('state') }}</strong>--}}
                                {{--</span>--}}
                               {{--@endif--}}
                           {{--</div>--}}
                       {{--</div>--}}


                       <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                       <label for="logo" class="col-sm-4 control-label">Logo</label>

                       <div class="col-sm-6">
                       <input type="file"  class="form-control" name="logo" id="logo" value="{{ old('logo') }}" required autofocus>

                       @if ($errors->has('logo'))

                       <span class="help-block" >
                         <strong>{{ $errors->first('logo') }}</strong>
                       </span>
                       @endif
                           @if($profile->logo == "")
                               <img src="{{ asset('images/spinner.gif') }}" alt="" width="120px" height="120px">
                           @else
                               <img src="{{ asset('images/.$profile->logo') }}" alt="" width="120px" height="120px">
                           @endif
                       </div>
                       </div>

                       <div class="form-group ">
                           <div class="col-sm-6 col-sm-offset-4">
                               <button type="submit" class="btn btn-success">
                                   Submit
                               </button>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Change Password</div>

                <div class="panel-body">
                    <form action="{{ route('profile.update',$profile->id) }}" class="form-horizontal" method="post">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password" class="col-sm-4 control-label">Password</label>

                            <div class="col-sm-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block" role="alert">
                                    <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="control-label col-sm-4">Confirm Password</label>

                            <div class="col-sm-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required >


                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block" >
                                    <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection

{{--.row>.col-sm-12>.col-sm-8.title>h2+.col-sm-4>a>button.btn.btn-primary.btn-block--}}

{{--col-sm-8 col-sm-offset-2--}}

{{--.row>.col-sm-8.col-sm-offset-2>.panel.panel-primary--}}