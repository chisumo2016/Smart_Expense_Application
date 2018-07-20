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

                <div class="budget-table">
                    <table class="table table-bordered ">
                        <thead>
                        <tr>
                            <th class="tbl-heading"><input type="checkbox" class="checkAll" name="checkAll"></th>
                            <th class="tbl-heading " style="text-align: left;">Request</th>
                            <th class="tbl-heading">£</th>
                            <th class="tbl-heading">Approvers</th>
                            <th class="tbl-heading">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <form action="" method="post" role="form">
                            {{ csrf_field() }}

                             @if(count($expenses) > 0)

                             @foreach($expenses as $row)
                             @if($row->company_id == Auth::user()->company_id)

                            <tr>
                            <td class="budget-expense-td">
                            <input type="checkbox" name="expenses[]" value="">
                            </td>
                            <td style="width: 600px; text-align: left; ">
                            <h5>
                            <a href="{{ route('expense.show',$row->id) }}">
                                {{ $row->subject }}             {{--Subject of the expense--}}
                            </a>
                            /
                            <span>{{ $row->item }}{{--Budget Item--}} (<span style="color: #142fba;">{{\App\Providers\Common::format_currency($row->budget - $row->price)}} &nbsp; BL</span>)</span>
                            </h5>

                            <p>From : <span>{{ $row->user }}</span> Created At :<span> {{ date('d-M-Y', strtotime($row->created_at)) }}}</span></p>
                            <p><strong>Comment Box :</strong></p>

                            </td>
                            <td>
                                <p> {{\App\Providers\Common::format_currency($row->budget )}}  </p>

                                    <a href="" style="text-decoration: none;">
                                        <span class="expense-overdue bg-">

                                           {{ $row->status }}

                                        </span>
                                    </a>

                            </td>
                            <td>
                                {{--logic approver--}}


                                @if($row->approver == ""  &&  $row->status == "Pending")

                                    <p>Not Approved Yet</p>
                                @elseif($row->approver != "" && $row->logo != "")

                                <p align="center"><img src="{{asset('images/'.$row->logo) }}" alt="" width="25px"></p>
                                <p>{{ $row->email }}</p>

                                @elseif($row->approver != "" && $row->logo == "")
                                    <p>{{ $row->email }}</p>

                                @endif




                            </td>
                            <td>
                                <div class="details-expenses">
                                    <h5>{{ $row->category }}</h5>

                                    <p><span>£&nbsp;{{ $row->price }}</span>&nbsp;requested</p>


                                    <p>
                                        <span style="color: #56ea48;">{{\App\Providers\Common::format_currency($row->budget - $row->price)}}&nbsp;left</span>
                                    </p>

                                    <p><strong>Priority: </strong>{{ $row->priority }}</p>
                                </div>


                            </td>
                            </tr>


                             @endif
                             @endforeach
                             @endif

                        </tbody>
                    </table>

                    <div class="col-sm-8 status_trigger status_trigger-col-sm-8">
                        <button class="btn btn-default pull-right btn-color" type="button"  onclick="closeexpenses()">Close</button>
                        <button class="btn btn-danger pull-right " type="button"  onclick="denyexpenses()">Deny</button>
                        <button class="btn btn-success pull-right " type="button"  onclick="approvalexpenses()">Approve</button>

                    </div>

                    </form><!-- end Form -->
                </div>
            </div>

        </div><!-- end col-sm-10 -->

    </div> <!-- end col-sm-12 -->
</div><!-- end row -->


@endsection

{{--.row>.col-sm-12--}}
{{--.row>.col-sm-2.sidebar+.col-sm-10--}}
{{--div>nav>ul.nav.navbar-inverse>li*5>a--}}
{{--div>nav>ul.nav.navbar-inverse>li*5>a--}}
{{--table.table.table-bordered>thead(tr>th.tbl-heading*5)+tbody(form>tr>td*5)--}}
{{--.col-sm-8.status_trigger>button*3--}}



{{--@if($row->approver == ""  &&  $row->status == "Pending")--}}

    {{--<p>Not Approved Yet</p>--}}
    {{--@if(!$row->approver =   "")--}}
        {{--@if($row->logo == "")--}}
            {{--<p></p>--}}
        {{--@else--}}
            {{--<p align="center"><img src="{{asset('images/$row->logo') }}" alt="" width="25px"></p>--}}

            {{--<p>{{ $row->email }}</p>--}}
        {{--@endif--}}
    {{--@endif--}}
{{--@endif--}}

