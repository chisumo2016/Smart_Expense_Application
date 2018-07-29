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
                        <ul class="nav navbar-inverse sidebar-expense">
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

                            <form action="/expenses/editstatus" method="post" role="form">

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
                            <input type="checkbox" name="expenses[]" value="{{ $row->id }}" class="expenses_checkbox">      {{--More than one array or input  expenses[] --}}
                            </td>

                            <td class="td-expense">
                            <h5>
                            <a href="{{ route('expense.show',$row->id) }}">
                                {{ $row->subject }}             {{--Subject of the expense--}}
                            </a>
                            /
                            <span>{{ $row->item }}{{--Budget Item--}} (<span style="color: #142fba;">{{\App\Providers\Common::format_currency($row->budget - $row->price)}} &nbsp; BL</span>)</span>
                            </h5>

                            <p>From : <span>{{ $row->user }}</span> Created At :<span> {{ date('d-M-Y', strtotime($row->created_at)) }}}</span></p>

                                @if($row->comments != '')
                                    <p><strong>Comment :</strong>{{ $row->comments }}</p>
                                @endif

                                <div style="clear:both; height: 8px;"></div>
                                
                                <div id="comments_box_{{$row->id}}"  class="comments_box_">
                                    <div class="comments_strong"><strong>Comments:</strong></div>
                                    <textarea class="validatecommentbox  validatecommentbox2" name="comments[{{ $row->id }}]" id="comments_{{ $row->id }}"></textarea>
                                    
                                    
                                    
                                </div>

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

                    @if(count($expenses) > 0)
                    @if(Auth::user()->role != 3)

                    <div class="col-sm-8 status_trigger status_trigger-col-sm-8">
                        <div id="com_warnings" style="color: red; margin-bottom: 10px; display: none;">Please fill comment box these are required</div>
                        <div id="acom_warnings" style="color: red; margin-bottom: 10px; display: none;">Please select the request first</div>

                        <button class="btn btn-danger "   name="status"  id="deniedsubmitbutton"      type="submit"  value="Denied"   style="visibility: hidden">Deny</button>
                        <button class="btn btn-danger "   name="status"  id="approvesubmitbutton"     type="submit"  value="Approved" style="visibility: hidden">Approve</button>
                        <button class="btn btn-success "  name="status"  id="closesubmitbutton"       type="submit"  value="Closed"   style="visibility: hidden">Close</button>


                        <button class="btn btn-default pull-right btn-color"    type="button"  onclick="closeexpenses()">Close</button>
                        <button class="btn btn-danger pull-right"               type="button"  onclick="denyexpenses()">Deny</button>
                        <button class="btn btn-success pull-right"              type="button"  onclick="approvalexpenses()">Approve</button>

                    </div>

                  @endif


                  @else
                   <h4>No Items Found</h4>
                  @endif

                    </form> <!-- end Form -->
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

    {{--Functions Close Expense--}}
<script>
    function  closeexpenses()
    {
       var commentcounter = 0;

       $(".expenses_checkbox").each(function () {
           var checking  = $(this).is(':checked');  // input
           if(checking === true)
           {
               commentcounter++;
           }

       });

       if (commentcounter > 0)
       {
          var confirmation = confirm('Are you sure ?');
          if(confirmation === true)
              $("#closesubmitbutton").trigger('click');
       }else
       {
            $("#acom_warnings").show().fadeOut(2500);
       }
    }

    {{--Functions Approve Expense--}}

    function  approvalexpenses()
    {
        var commentcounter = 0;

        $(".expenses_checkbox").each(function () {  // each field of ckk box
            var checking  = $(this).is(':checked');  // input
            if(checking === true)
            {
                commentcounter++;
            }

        });

        if (commentcounter > 0)
        {
            var confirmation = confirm('Are you sure ?');
            if(confirmation === true)

                $("#approvesubmitbutton").trigger('click');  //Will submit a request to  form
        }else
        {
            $("#acom_warnings").show().fadeOut(2500);
        }

    }

   /*Function to Deny Expenses  */
    function denyexpenses()
    {
        $(".expenses_checkbox").each(function () {
            var checking   = $(this).is(':checked');
            var checkboxid = $(this).val();

            if(checking == true)
            {
                window.scrollTo(0, 200);
                 $("#comments_box_"+checkboxid).slideDown('slow');
            }else
            {
                $("#comments_box_"+checkboxid).slideUp('slow');
                $("#com_warnings").hide();
            }
        });

        //B
        var commentcounter = 0;

        $(".expenses_checkbox").each(function () {  // each field of ckk box
            var checking  = $(this).is(':checked');  // input
            if(checking === true)
            {
                commentcounter++;
                //alert(commentcounter);
            }
        });


        //Validate comments box
        var allfilledtextarea  = $(".validatecommentbox").filter(function () {
            return this.value;

        });

        //alert(allfilledtextarea.length);

        if(allfilledtextarea.length == 0)
        {
            $("#com_warnings").show().fadeOut(2500);
        }else if(allfilledtextarea.length == commentcounter)
        {
            var confirmation = confirm('Are you sure ?');
            $("#com_warnings").hide();

            if (confirmation == true)
            {
                $("#deniedsubmitbutton").trigger('click');
            }
        }
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

