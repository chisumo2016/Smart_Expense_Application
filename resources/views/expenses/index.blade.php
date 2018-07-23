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
                                <option value="{{  $row->id }}"<?php if($period == $row->id){ echo 'selected = "selected"';} ?> >{{ \App\Providers\Common::formatDate($row->from) }} to {{ \App\Providers\Common::formatDate($row->to) }}</option>
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
                    <!--  {{--<?php if ($status == "all")     {echo 'class="active"';}?> Seeting Background active--}}-->
                        <ul class="nav navbar-inverse sidebar-expense" >
                            <li <?php if ($status == "all")     {echo 'class="active"';}?>><a href="/expenses?department={{ $department }}&status=all&period={{ $period }}&page=1"      <?php if ($status == "all"){echo 'class="bg-blue"';}?>>All Expenses</a></li>
                            <li <?php if ($status == "Pending") {echo 'class="active"';}?>><a href="/expenses?department={{ $department }}&status=Pending&period={{ $period }}&page=1"<?php if ($status   == "Pending"){echo 'class="bg-blue"';}?>>Pending</a></li>
                            <li <?php if ($status == "Denied")  {echo 'class="active"';}?>><a href="/expenses?department={{ $department }}&status=Denied&period={{ $period }}&page=1"<?php if ($status    == "Denied"){echo 'class="bg-blue"';}?>>Denied</a></li>
                            <li <?php if ($status == "Approved") {echo 'class="active"';}?>><a href="/expenses?department={{ $department }}&status=Approved&period={{ $period }}&page=1 <?php if ($status == "Approved"){echo 'class="bg-blue"';}?>">Approved</a></li>
                            <li <?php if ($status == "Closed")  {echo 'class="active"';}?>><a href="/expenses?department={{ $department }}&status=Close&period={{ $period }}&page=1" <?php if ($status == "Closed"){echo 'class="bg-blue"';}?>>Closed</a></li>
                        </ul>
                    </nav>
                </div>


                <div class="departments">
                    <select name="" id="" class="form-control" data-placeholder="departments" onchange="change_department($(this).val())">
                        <option value="all">All Department</option>

                        @if(count($categories) > 0)
                            @foreach($categories as $row)
                                {{--settin Background selected <?php if($period == $row->id){ echo 'selected = "selected"';} ?>--}}
                                <option value="{{  $row->id }}" <?php if($department == $row->id){ echo 'selected = "selected"';} ?>>{{ $row->name }}</option>
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

                                 {{--Colors--}}
                            <?php
                               $color = "purple" ;

                               if($row->status == "Pending"){$color  = "yellow";}
                               if($row->status == "Approved"){$color  = "green";}
                               if($row->status == "Denied"){$color    = "red";}
                               if($row->status == "Closed"){$color    = "black";}

                            ?>



                            <tr class="border-{{ $color }}">
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
                                        <span class="expense-overdue bg-{{ $color }}">

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
                                <p>{{ $row->user }}</p>
                                <p>{{ $row->email }}</p>

                                @elseif($row->approver != "" && $row->logo == "")
                                    <p>{{ $row->user }}</p>
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

@section('script')
{{--Creating URL by Javascript Function--}}
<script>
    function change_period(id)
    {
        var url = '/expenses?department={{ $department }}&status={{ $status }}&period='+id+'';
        //Change location of the window
        window.location = url;
    }

    function change_department(id)
    {
        var url = '/expenses?department='+id+'&status={{ $status }}&period={{ $period }}';
        //Change location of the window
         window.location = url;
    }



</script>

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

