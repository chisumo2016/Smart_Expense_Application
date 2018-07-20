@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-2">
                <h2 style="color: #000000; text-align: center;">Expenses</h2>
            </div><!-- end col-sm-2 -->

            <div class="col-sm-3" style="margin-top: 22px; text-decoration: none;">
                <a href="{{ route('expense.index') }}">
                    <button class="btn btn-default btn-block">List All &nbsp; <i class="fa fa-list"></i></button>
                </a>
            </div><!-- end col-sm-3 -->

            <div class="col-sm-3" style="margin-top: 22px; text-decoration: none;">
                <a href="{{ route('expense.create') }}">
                    <button class="btn btn-primary btn-block">Add New Expense &nbsp; <i class="fa fa-plus"></i></button>
                </a>
            </div><!-- end col-sm-3 -->

            <div class="col-sm-4" style="margin-top: 22px;">
                <div class="dropdown">
                    <select class="form-control " onchange="change_period($(this).val())">
                        <option value="all">Choose Budget Period</option>

                        @if(count($periods) > 0)
                            @foreach($periods as $row)
                                <option value="{{  $row->id }}">{{ \App\Providers\Common::formatDate($row->from) }} to {{ \App\Providers\Common::formatDate($row->to) }}</option>
                            @endforeach
                        @endif

                    </select>
                </div>
            </div><!-- end col-sm-4 -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-sm-2 sidebar">
                <h2>Sidebar</h2>
            </div><!-- end sidebar -->
            <div class="col-sm-10">
                <h3>Table Content</h3>
            </div>
        </div><!-- end col-sm-10 -->

    </div> <!-- end col-sm-12 -->
</div><!-- end row -->


@endsection

{{--.row>.col-sm-12--}}
{{--.row>.col-sm-2.sidebar+.col-sm-10--}}

