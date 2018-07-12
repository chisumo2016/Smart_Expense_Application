@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">

            @include('periods.create-period')
            @include('categories.create-category')

        </div>
    </div>

    <hr>
    <div class="row">

    </div>
@endsection

{{--.row>.col-sm-12--}}