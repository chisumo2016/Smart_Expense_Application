@extends('layouts.authApp')

@section('authcontent')

<div class="container">

    <div class="row">

        <div class="col-sm-8 col-sm-4 col-sm-offset-2">

            <div class="col-sm-12 col-sm-4"></div>
                <div class="col-sm-12 col-sm-4 register-top">

                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            {{ csrf_field()  }}

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <h3 class="text-center">Sign Up to <span class="text-color">Smart Expense Keeping</span></h3>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="name" class="col-sm-4 col-sm-2 col-form-label">Name:</label>

                                <div class="col-sm-6 col-sm-2">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 col-form-label col-sm-2">'E-Mail Address</label>

                                <div class="col-sm-6 col-sm-2">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="password" class="col-sm-4 col-form-label col-sm-2">Password</label>

                                <div class="col-sm-6 col-sm-2 ">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="password-confirm" class="col-sm-4 col-form-label col-sm-2">Confirm Password</label>

                                <div class="col-sm-6 col-sm-2 ">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <div class="col-sm-6 offset-sm-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
    </div> <!-- col-8-->
    </div><!-- row-->
</div>  <!-- Container-->
@endsection
