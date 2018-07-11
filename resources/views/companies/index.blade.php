@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-8 title">
                <h2>Companies</h2>
            </div>
            <div class="col-sm-4 company-style">
                <a href="{{ route('company.create') }}">
                    <button class="btn btn-primary">{{ trans('app.companies-create') }} &nbsp; <i class="fa fa-plus"></i></button>
                </a>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <a href="">List of Companies</a>
        </div>
    </div>

@endsection

{{--.row>.col-sm-12>.col-sm-8.title>h2+.col-sm-4>a>button.btn.btn-primary--}}