
    <div class="col-sm-6">
        <h4><b>Category</b></h4>
        <hr>

        <form action="#" method="post" role="form" class="form-horizontal">
            {{ csrf_field() }}

            <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id">  <!--Relationship-->

            <div class="form-group">

                <label for="name" class="col-sm-2 form-control-label">Name :</label>

                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name">
                    @if($errors->has('name'))
                        <span class="help-block">
                            <strong class="text-center">{{ $errors->first('name') }}</strong>
                         </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit"  class="btn btn-success" >Add Category</button>
                </div>
            </div>
        </form>
    </div>


{{--.col-sm-6>h4+hr--}}
{{--.form-group>label+.col-sm-8>input--}}