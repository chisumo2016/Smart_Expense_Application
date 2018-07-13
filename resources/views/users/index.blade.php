@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-sm-8">
                <h2>All Users </h2>
            </div>
            <div class="col-sm-4" style="margin-top: 22px;">
                <a href="{{ route('user.create') }}">
                    <button class="btn btn-primary btn-block">Add Users &nbsp; <i class="fa fa-plus"></i></button>
                </a>
            </div>
        </div>
    </div>

@endsection