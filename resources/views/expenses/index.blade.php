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
                <div>
                    <nav>
                        <ul class="nav navbar-inverse sidebar-expense" >
                            <li><a href="/expenses?department=1&status=all&period=&page=1">All Expenses</a></li>
                            <li><a href="/expenses?department=1&status=Pending&period=&page=1">Pending</a></li>
                            <li><a href="/expenses?department=1&status=Denied&period=&page=1">Denied</a></li>
                            <li><a href="/expenses?department=1&status=Approved&period=&page=1">Approved</a></li>
                            <li><a href="/expenses?department=1&status=Close&period=&page=1">Close</a></li>
                        </ul>
                    </nav>
                </div>


                <div class="departments">
                    <select name="" id="" class="form-control" data-placeholder="departments" onchange="change_department($(this).val())">
                        <option value="all">All Department</option>

                        @if(count($categories) > 0)
                            @foreach($categories as $row)
                                <option value="{{  $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
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
{{--div>nav>ul.nav.navbar-inverse>li*5>a--}}
{{--div>nav>ul.nav.navbar-inverse>li*5>a--}}

