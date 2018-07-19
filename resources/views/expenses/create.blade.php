@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-8 ">
                <h2>Add New Expense</h2>
            </div>
            <div class="col-sm-4" style="margin-top: 22px;">
                <a href="{{ route('expense.index') }}">
                    <button class="btn btn-primary btn-block"> All Expense &nbsp; <i class="fa fa-arrow-circle-left"></i></button>
                </a>
            </div>

        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <form action="{{ route('expense.store') }}" class="form-horizontal" method="post" id="expenses" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id">
                <input type="hidden" value="{{ old('outside') }}" name="outside" id="outside">


                <div class="form-group">
                    <label for="" class="col-sm-2 form-control-label">Budget Item</label>
                    <div class="col-sm-10">
                        <select name="budget_id" id="budget_id"  required=""  class="form-control required " onchange="change_budget($(this.val()))">
                            <option value="">Choose Budget Item</option>

                            @if(count($budgets) > 0)

                                @foreach($budgets as $row)
                                    <option value="#"></option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                </div>  <!--End group Item-->

                <div class="form-group">
                    <label for="" class="col-sm-2 form-control-label">Priority</label>
                    <div class="col-sm-10">
                        <select name="priority" id="priority"  required=""  class="form-control required " onchange="change_budget($(this.val()))">
                            <option value="">Choose Budget Item</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="">Low</option>


                            {{--@if(count($budgets) > 0)--}}

                            {{--@foreach($budgets as $row)--}}
                            {{--<option value="#"></option>--}}
                            {{--@endforeach--}}
                            {{--@endif--}}

                        </select>
                    </div>
                </div>  <!--End group Priority-->

                <div class="form-group {{ $errors->has('price')  ? 'has-error' : ''}}">

                    <label for="price" class="col-sm-2 form-control-label">Price</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="price"  name="price" value="{{ old('price') }}">

                        <p class="red" id="out_of_budget" style="display: none;">Sorry! Your price id out of the item budget.</p>

                        @if($errors->has('price'))
                            <span class="help-block">
                        <strong class="text-center">{{ $errors->first('price') }}</strong>
                     </span>
                        @endif
                    </div>
                </div> <!--End group Price-->


                <div class="form-group {{ $errors->has('subject')  ? 'has-error' : ''}}">

                    <label for="subject" class="col-sm-2 form-control-label">Subject</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="subject"  name="subject" value="{{ old('subject') }}">

                        <p class="red" id="out_of_budget" style="display: none;">Sorry! Your price id out of the item budget.</p>

                        @if($errors->has('subject'))
                            <span class="help-block">
                        <strong class="text-center">{{ $errors->first('subject') }}</strong>
                     </span>
                        @endif
                    </div>
                </div> <!--End group Subject-->

                <div class="form-group {{ $errors->has('description')  ? 'has-error' : ''}}">

                    <label for="subject" class="col-sm-2 form-control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea name="description" id="editor"  rows="8" class="form-control">{{ old('description') }}</textarea>


                        @if($errors->has('description'))
                            <span class="help-block">
                        <strong class="text-center">{{ $errors->first('description') }}</strong>
                     </span>
                        @endif
                    </div>
                </div> <!--End group description-->

                <div class="form-group {{ $errors->has('file')  ? 'has-error' : ''}}">

                    <label for="file" class="col-sm-2 form-control-label">File</label>
                    <div class="col-sm-10">
                        <input type="file"  name="file" id="file" class="form-control" value="{{ old('file') }}">

                        @if($errors->has('file'))
                            <span class="help-block">
                        <strong class="text-center">{{ $errors->first('file') }}</strong>
                     </span>
                        @endif
                    </div>
                </div> <!--End group file-->


                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-success btn-block">submit</button>
                    </div>
                </div>


            </form>
        </div> <!--End col-sms-8-->
    </div>  <!--End Row-->

@endsection

{{--.row>.col-sm-8.col-sm-offset-2.form.form-horizontal--}}