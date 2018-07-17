@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-sm-8">
                <h2>Edit  User </h2>
            </div>
            <div class="col-sm-4" style="margin-top: 22px;">
                <a href="{{ route('user.index') }}">
                    <button class="btn btn-primary btn-block">All Users &nbsp; <i class="fa fa-arrow-circle-left"></i></button>
                </a>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <form action="{{ route('user.update', $user->id) }}" class="form-horizontal" role="form" method="post">
                {{ csrf_field() }}

                <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id">
                <input type="hidden" value="{{ Auth::user()->country }}" name="country">
                <input type="hidden" value="{{ Auth::user()->state }}" name="state">

                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">

                    <label for="name" class="col-sm-2 col-form-label">Name: </label>

                    <div class="col-sm-10">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" >

                        @if ($errors->has('name'))
                            <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>


                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" class=" col-sm-2 col-form-label">'E-Mail Address</label>

                    <div class="col-sm-10">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" >

                        @if ($errors->has('email'))
                            <span class="help-block" role="alert">
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>



                {{--<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">--}}
                    {{--<label for="password" class=" col-form-label col-sm-2">Password</label>--}}

                    {{--<div class="col-sm-10">--}}
                        {{--<input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">--}}

                        {{--@if ($errors->has('password'))--}}
                            {{--<span class="help-block" role="alert">--}}
                                    {{--<strong class="text-danger">{{ $errors->first('password') }}</strong>--}}
                                {{--</span>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label for="password" class=" col-form-label col-sm-2">Phone</label>

                    <div class="col-sm-10">
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}" >

                        @if ($errors->has('phone'))
                            <span class="help-block" role="alert">
                                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                    <label for="city" class="col-sm-2 form-control-label">City</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="city" id="city" value="{{ $user->city }}" placeholder="City" autofocus>
                        @if ($errors->has('city'))
                            <span class="help-block" >
                                    <strong class="text-danger">{{ $errors->first('state') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label for="address" class="col-sm-2 form-control-label">Address</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}" placeholder="Address" autofocus>
                        @if ($errors->has('address'))
                            <span class="help-block" >
                                    <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
                    <label for="city" class="col-sm-2 form-control-label">Postal Code</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="postal_code" id="postal_code" value="{{ $user->postal_code }}" placeholder="Postal Code" autofocus>
                        @if ($errors->has('postal_code'))
                            <span class="help-block" >
                                    <strong  class="text-danger">{{ $errors->first('postal_code') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                {{--onchange="accessibilities($(this).val())--}}
                <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}" >

                    <label for="role" class="col-sm-2 form-control-label">Role :</label>
                    <div class="col-sm-10">
                        <select name="role" id="role" class="form-control" onchange="accessibilities($(this).val())">
                            <option value="">Choose Role</option>

                            @if(count($roles) > 0)
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            @endif
                        </select>

                        @if ($errors->has('role'))
                            <span class="help-block" >
                                    <strong class="text-danger">{{ $errors->first('role') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group" id="accessibilities" style="display: none">
                    <label for="permission" class="col-sm-2 form-control-label">Permission</label>
                    <div class="col-sm-10">
                        @if(count($companies))
                            @foreach($companies as $company)
                                <label for=""> <input type="checkbox" name="access[{{ $company->id }}]" onclick="categories($(this) {{ $company->id }})"  value="{{$company->id}}">&nbsp;{{ $company->name }}</label><br>
                                @if(count(\App\Category::whereUser($company->id)))

                                    <ul style="list-style: none;" id="checkbox_{{ $company->id }}">

                                        @foreach(\App\Category::whereUser($company->id) as $category)
                                            <li>
                                                <label for=""><input type="checkbox" class="categories" value="{{ $category->id }}" name="access[{{ $company->id }}][]">&nbsp; {{$category->name}}</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                    <label for="status" class="col-sm-2 form-control-label">Status</label>
                    <div class="col-sm-10">
                        <select id="status" class="form-control" name="status">
                            <option value="on" selected="">Active</option>
                            <option value="off" >Deactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button class="btn btn-success btn-block">Submit</button>
                    </div>
                </div>


            </form>
        </div>
    </div>


@endsection

{{--Jquery Function for Role -ACL--}}
@section('script')

    <script>
        function accessibilities(role)
        {
            if(role ==    1 || role == '')
            {
                $("#accessibilities").attr("type", "checkbox");
                $("#accessibilities").show();
            }

            if(role ==  2 )
            {
                $(".categories").attr("type", "checkbox");
                $("#accessibilities").show();
            }

            if(role ==  3 )
            {
                $(".categories").attr("type", "radio");
                $("#accessibilities").show();
            }

        }

        {{--Jquery Function for uchecked  checkbox -ACL--}}
        function categories(e, id)
        {
            if(e.is(":checked"))
            {

            }else {
                $("#checkbox_"+id).hide();
            }
        }
    </script>


@endsection
{{--.row>.col-md-12>.col-sm-8>h2>.col-sm-4>a--}}
{{--.row>col-sm-8.col-sm-offset-2>form.form-horizontal--}}
{{--.form-group#accessibility>label+.col-sm-10>label+input+ul>li--}}

