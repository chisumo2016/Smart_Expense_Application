@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-8 title">
                <h2>{{ $title }}</h2>
            </div>
            <div class="col-sm-4 company-style">
                <a href="{{ route('company.index') }}">
                    <button class="btn btn-primary btn-block">Companies &nbsp; <i class="fa fa-arrow-circle-left"></i></button>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-6 col-sm-offset-3">

                <form action="{{ route('company.store') }}" class="form-horizontal" role="form" method="post">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name" class="col-sm-2 form-control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder=" Name:">
                            @if($errors->has('name'))
                                <span class="help-block">
                                    <strong class="text-center">{{ $errors->first('name') }}</strong>
                                </span>

                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="submit" class="btn btn-info pull-right">
                                submit
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>  <!-- end of row Name->
@endsection

{{--.row>.col-sm-12>.col-sm-8.title>h2--}}
{{--.col-sm-4>a>button--}}
{{--.row>.col-sm-12>.col-sm-6.col-sm-offset-3--}}
{{--.form-group>label+.col-sm-10>input--}}
{{--.form-group>.col-sm-10.col-sm-offset-2>button.bt.btn-info.pull-right--}}