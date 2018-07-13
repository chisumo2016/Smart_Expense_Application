
@extends('layouts.main')

@section('content')
<div class="col-sm-8 col-sm-offset-2">
<h4>
    <b> Edit Periods</b>
</h4>
<hr>

<a href="{{ route('categories-periods.index') }}"><button class="btn btn-primary">Back to Periods</button></a>


<div class="col-sm-12">
    <h4><b>Edit Period</b></h4>

    @if($errors->has('from'))
        <span class="help-block">
        <strong class="text-danger">{{$errors->first('from') }}</strong>
    </span>
    @endif

    @if($errors->has('to'))
        <span class="help-block">
        <strong class="text-danger">{{$errors->first('to') }}</strong>
    </span>
    @endif

    <hr>

    <form action="{{ route('period.update', $period->id) }}" method="post" role="form" class="form-horizontal">
        {{ csrf_field() }}

        <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id">  <!--Relationship-->

        <div class="form-group">

            <label for="range" class="col-sm-2 form-control-label">Range :</label>

            <div class="col-sm-8">

                <div class="input-datarange input-group" id="data-range">

                    <input type="text" name="from" id="from" size="10px"  value="{{ date('Y-m-d',strtotime($period->from)) }}">

                    <span style="background-color: #51595e; color: white; padding: 6px;">to</span>

                    <input type="text" name="to" id="to" size="10px" value="{{ date('Y-m-d',strtotime($period->to)) }}">

                </div>

            </div>
            <div class="form-group">
                <button type="submit"  class="btn btn-success pull-left" >Update Periods</button>
            </div>
        </div>

    </form>
</div>
</div>

@endsection
@section('script')
    <script>
        $(function () {

            $("#from").datepicker({

                defaultDate: "1w",
                changeMonth: true,
                numberOfMonth: 1,
                changeYear: true,
                dateFormat: "yy-mm-dd",
                onClose: function (selectedDate) {
                    $("to").datepicker("option","minDate",selectedDate);
                }

            });

            $("#to").datepicker({
                defaultDate: "1w",
                changeMonth: true,
                numberOfMonth: 1,
                changeYear: true,
                dateFormat: "yy-mm-dd",
                onClose: function (selectedDate) {
                    $("from").datepicker("option","maxDate",selectedDate);
                }

            });
        });   /** End of Function  **/
    </script>

@endsection



{{--.col-sm-8.col-sm-offset-2>h4>b+hr--}}
{{--.form-group>label+.col-sm-8>input--}}
{{--.input-datarange.input-group#data-range--}}