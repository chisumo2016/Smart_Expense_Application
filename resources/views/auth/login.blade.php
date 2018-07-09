@extends('layouts.authApp')

@section('authcontent')

<div class="col-sm-4"></div>

    <div class="col-sm-4 register-top-login">

            <form class="form-horizontal register-container tb-padding" role="form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
             {{ csrf_field() }}
                <div class="form-group">
                    <div class="col-sm-12">
                        <h3 class="text-center">Login to <span class="text-color">Smart Expense Keeping</span></h3>
                    </div>
                </div>

                <div class="form-group">
                    {{--<label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>--}}

                    <div class="col-sm-12">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email">

                        @if ($errors->has('email'))
                            <span class="help-block" >
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group ">
                    {{--<label for="password" class="col-sm-4 col-form-label text-md-right">Password</label>--}}

                    <div class="col-sm-12">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                        @if ($errors->has('password'))
                            <span class="help-block" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-2 ">
                         <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>

                    </div>
                    <div class="col-xs-10 no-padding margin-style"> Remember Me</div>
                </div>

                <div class="form-group ">
                    <div class="col-sm-12 ">
                        <input type="submit"  value="Log In" class="btn btn-danger btn-block">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-sm-12 ">
                      <i class="fa fa-lock"><a href="{{ route('password.request') }}" class="forgot-link">Forgot your Password ?</a></i>
                    </div>
                </div>
            </form>
            <h5 class="text-center">Don't have an account ? <a href="{{ route('register') }}">Sign Up</a></h5>
            <h5 class="text-center">Developed By Bernard Chisumo<a href="http://www.chisumos.com">Online Shop</a></h5>

    </div>

@endsection
