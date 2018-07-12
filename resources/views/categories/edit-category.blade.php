@extends('layouts.main')

@section('content')
<div class="row">

    <div class="col-sm-8 col-sm-offset-2">

        <h4><b>Edit Category</b></h4>
        <hr>

        <form action="{{ route('category.update', $category->id )}}" class="form-horizontal" role="form" method="post">

            {{ csrf_field() }}

            <input type="hidden" value="{{ $category->id }}" name="category_id">

            <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id">  <!--Relationship-->

            <div class="form-group">

                <label for="name" class="col-sm-2 form-control-label">Name :</label>

                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="{{ $category->name }}">

                    @if($errors->has('name'))
                        <span class="help-block">
                        <strong class="text-center">{{ $errors->first('name') }}</strong>
                     </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit"  class="btn btn-success"> Add </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

{{--.row>.col-sm-8.col-sm-offset-2--}}