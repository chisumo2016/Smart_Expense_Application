
    <div class="col-sm-6">
        <h4><b>Add Period</b></h4>

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

        <form action="{{ route('period.store') }}" method="post" role="form" class="form-horizontal">
            {{ csrf_field() }}

            <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id">  <!--Relationship-->

            <div class="form-group">

                <label for="range" class="col-sm-2 form-control-label">Range :</label>

                <div class="col-sm-8">

                    <div class="input-datarange input-group" id="data-range">

                        <input type="text" name="from" id="from" size="15px" >

                        <span style="background-color: #51595e; color: white; padding: 6px;">to</span>

                        <input type="text" name="to" id="from" size="15px">

                    </div>

                </div>
                <div class="form-group">
                    <button type="submit"  class="btn btn-success pull-left" >Add Periods</button>
                </div>
            </div>

        </form>
    </div>


{{--.col-sm-6>h4+hr--}}
{{--.form-group>label+.col-sm-8>input--}}
{{--.input-datarange.input-group#data-range--}}