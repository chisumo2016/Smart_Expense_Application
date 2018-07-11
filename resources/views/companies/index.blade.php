@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-8  title">
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
            <?php $i = 0;  ?>
            @if(count($companies) > 0)
                @foreach($companies as $company)
                    {{--Accessing colors--}}
                    <?php
                       $class = (Auth::user()->company_id == $company->id ? "bg-{$colors[$i]}" : "border-{$colors[$i]}")  ;
                    ?>
                    <a href="">
                    <div class="departs-group {{ $class }}">
                        <p>{{ $company->name }}</p>
                    </div>

                    </a>

                    <?php if($i == count($colors)-1) {$i=-1;} $i++ ?>
                @endforeach
            @endif

        </div>
    </div>

@endsection

{{--.row>.col-sm-12>.col-sm-8.title>h2+.col-sm-4>a>button.btn.btn-primary--}}

{{--col-sm-8 col-sm-offset-2--}}