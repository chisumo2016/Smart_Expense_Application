@extends('layouts.authApp')

@section('authcontent')

<div class="col-sm-8  col-sm-offset-2">

    <div class="col-sm-12 "></div>
        <div class="col-sm-12  register-top">

                <form class="form-horizontal register-container tb-padding" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                    {{ csrf_field()  }}

                    <div class="form-group">
                        <div class="col-sm-12">
                            <h3 class="text-center">Register To <span class="text-color">Smart Expense Keeping</span>  <span class="text-color">Application</span></h3>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>

                        <div class="col-sm-10">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class=" col-sm-2 col-form-label">'E-Mail Address</label>

                        <div class="col-sm-10">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="password" class=" col-form-label col-sm-2">Password</label>

                        <div class="col-sm-10">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="password-confirm" class=" col-form-label col-sm-2">Confirm Password</label>

                        <div class="col-sm-10">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="country" class="col-form-label col-sm-2">Country</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="country" id="country">
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
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="state" class="col-sm-2 form-control-label">State</label>

                        <div class="col-sm-10 ">
                            <select class="form-control" name="state" id="state">
                                <option value="">Choose State 1</option>
                                <option value="">Choose State  2</option>
                                <option value="">Choose State  3</option>
                                <option value="">Choose State  4</option>
                            </select>

                            @if ($errors->has('state'))
                                <span class="help-block" >
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-sm-2 form-control-label">City</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}" placeholder="City">
                            @if ($errors->has('city'))
                                <span class="help-block" >
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address" class="col-sm-2 form-control-label">Address</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}" placeholder="Address">
                            @if ($errors->has('address'))
                                <span class="help-block" >
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="city" class="col-sm-2 form-control-label">Postal Code</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" placeholder="Postal Code">
                            @if ($errors->has('postal_code'))
                                <span class="help-block" >
                                    <strong>{{ $errors->first('postal_code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="logo" class="col-sm-2 form-control-label">Logo</label>

                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="logo" id="logo" value="{{ old('logo') }}">

                            @if ($errors->has('logo'))
                                <span class="help-block" >
                                    <strong>{{ $errors->first('logo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <div class="col-sm-10 col-sm-offset-1">
                            <button type="submit" class="btn btn-danger btn-block">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
               <h5 class="text-center">Already  have an account ? <a href="{{ route('login') }}">Sign In</a></h5>

                <div class="col-sm-10"></div>
        </div>
</div> <!-- col-8-->

@endsection
