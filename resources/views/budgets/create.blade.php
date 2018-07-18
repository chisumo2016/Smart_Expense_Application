@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-8 title">
            <h2>Add New Budget</h2>
        </div>
        <div class="col-sm-4 company-style">
            <a href="{{ route('budget.index') }}">
                <button class="btn btn-primary btn-block">All Budgets &nbsp; <i class="fa fa-arrow-circle-left"></i></button>
            </a>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 100px;">
    <div class="col-sm-8 col-sm-offset-2" >
        <form action="{{ route('budget.store') }}" class="form-horizontal" method="post" role="form">
            {{ csrf_field() }}

            <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id">

            <div class="form-group">
                <label for="department" class="col-sm-2 form-control-label">Department</label>
                <div class="col-sm-10">
                    <select  id="department" class="form-control required" required="" name="category_id">
                        <option value="">Choose Department</option>

                        @if(count($categories) > 0)
                            @foreach($categories as $category)

                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label for="periods" class="col-sm-2 form-control-label">Periods</label>
                <div class="col-sm-10">
                    <select  id="period" class="form-control required" required="required" name="period_id">
                        <option value="">Choose Period</option>

                        @if(count($periods) > 0)
                            @foreach($periods as $period)

                                <option value="{{ $period->id }}">{{ date('F d, Y', strtotime($period->from)).' To '.date('F d, Y', strtotime($period->to)) }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label for="item" class="col-sm-2 form-control-label">Item</label>
                <div class="col-sm-10">

                    <input type="text" class="form-control" name="item" value="{{ old('item') }}">

                    @if($errors->has('item'))
                        <span class="help-block">
                        <strong class="text-center">{{ $errors->first('item') }}</strong>
                     </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="item" class="col-sm-2 form-control-label">Unit Price</label>
                <div class="col-sm-10">

                    <input type="text" class="form-control" name="unit" value="{{ old('unit') }}" onkeyup="calculatingBudget()">

                    @if($errors->has('unit'))
                        <span class="help-block">
                        <strong class="text-center">{{ $errors->first('unit') }}</strong>
                     </span>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <label for="item" class="col-sm-2 form-control-label">Quantity</label>
                <div class="col-sm-10">

                    <input type="text" class="form-control" name="quantity" value="{{ old('quantity') }}" onkeyup="calculatingBudget()">

                    @if($errors->has('quantity'))
                        <span class="help-block">
                        <strong class="text-center">{{ $errors->first('quantity') }}</strong>
                     </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="item" class="col-sm-2 form-control-label">Budget</label>
                <div class="col-sm-10">

                    <input type="text" class="form-control" name="budget" value="{{ old('budget') }}" readonly="readonly">

                    @if($errors->has('budget'))
                        <span class="help-block">
                        <strong class="text-center">{{ $errors->first('budget') }}</strong>
                     </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="submit"  class="btn btn-success btn-block"> Submit Budget </button>
                </div>
            </div>



        </form>
    </div>
</div>




@endsection



{{--.row>.col-sm-12>.col-sm-8.title>h2--}}

{{--.row>.col-sm-8.col-sm-offset-2>form.form-horizontal--}}