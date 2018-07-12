@extends('layouts.main')

@section('content')
    <div class="col-sm-6">
        <h4><b>Category</b></h4>
        <hr>

        <form action="{{ route('category.store') }}" method="post" role="form" class="form-horizontal">
            {{ csrf_field() }}

            <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id">  <!--Relationship-->

            <div class="form-group">

                <label for="name" class="col-sm-2 form-control-label">Name :</label>

                <div class="col-sm-8">
                    <input type="text" class="form-control" name="name">
                    @if($errors->has('name'))
                        <span class="help-block">
                            <strong class="text-center">{{ $errors->first('name') }}</strong>
                         </span>
                    @endif
                </div>
                <button class="btn btn-success">Add Category</button>
            </div>
        </form>
    </div>
@endsection

{{--.col-sm-6>h4+hr--}}
{{--.form-group>label+.col-sm-8>input--}}