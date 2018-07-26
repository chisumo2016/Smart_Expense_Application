@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-8">
                <h2>Expenses</h2>
            </div>
            <div class="col-sm-4" style="margin-top: 22px;">

                <a href="{{ route('expense.index') }}">
                    <button class="btn btn-primary btn-block">List Expense &nbsp; <i class="fa fa-arrow-circle-left"></i></button>
                </a>

            </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row" style="margin-top: 10px;">
        <div class="col-sm-10 col-sm-offset-1">
            <table class="table table-bordered expense-table">
                <tr>
                    <th>ID: </th>
                     <td>{{ $row->id }}</td>
                </tr>
                <tr>
                    <th>Item: </th>
                    <td>{{ $row->item }}</td>
                </tr>

                <tr>
                    <th>From: </th>
                    <td>{{ $row->user }}</td>
                </tr>

                <tr>
                    {{--Colors--}}
                    <?php
                    $color = "purple" ;

                    if($row->status == "Pending")   {$color  =  "yellow";}
                    if($row->status == "Approved")  {$color  = "green";}
                    if($row->status == "Denied")    {$color  = "red";}
                    if($row->status == "Closed")    {$color  = "black";}

                    ?>
                    <!-- Creating Button and Dropdown  -->
                    <th>Status: </th>
                    <td>
                        <span class="expens-e-overdue bg-{{ $color }}" style="float:left;">{{ $row->status }} </span>
                        <div  style="float:right; margin-top: 3px;">

                            <select name="" id="expense_status_{{ $row->id }}" style="float: left; margin-top: 5px; margin-right: 10px;">

                                <option <?php if($row->status == 'Approved'){echo   'selected="selected"';}?>   value="Approved">Approved</option>
                                <option <?php if($row->status == 'Pending'){echo    'selected="selected"';}?>   value="Pending">Pending</option>
                                <option <?php if($row->status == 'Denied'){echo     'selected="selected"';}?>   value="Denied">Denied</option>
                                <option <?php if($row->status == 'Closed'){echo     'selected="selected"';}?>   value="Closed">Closed</option>

                                <option <?php if($row->status == 'Overdue'){echo    'selected="selected"';}?>   value="Overdue">Overdue</option>

                            </select>

                            <button type="button" class="btn btn-success" onclick="changestatussingle({{ $row->id }})" style="width: auto; padding: 3px 8px;">Update Status</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Budget: </th>
                    <td>{{ $row->budget }}</td>
                </tr>
                <tr>
                    <th>Priority: </th>
                    <td>{{ $row->priority }}</td>
                </tr>

                <tr>
                    <th>Requested: </th>
                    <td>{{ $row->price}}</td>
                </tr>
                <tr>
                    <th>Left: </th>
                    <td>£ {{ $row->budget-$row->price }}</td>
                </tr>
                <tr>
                    <th>Department </th>
                    <td>{{ $row->category }}</td>
                </tr>
                <tr>
                    <th>Subject: </th>
                    <td>{{ $row->subject }}</td>
                </tr>
                <tr>
                    <th>Description: </th>
                    <td>{!! $row->description  !!}</td>
                </tr>
                <tr>
                    <th>Approval :</th>
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
                </tr>

                <tr>
                    <th>Created : </th>
                    <td>{{ \App\Providers\Common::formatDate($row->created_at) }}</td>
                </tr>

                <tr>
                    <th>Last Activity: </th>
                    <td>{{ date('m D Y, H:m:s A', strtotime($row->updated_at)) }}</td>
                </tr>

                <tr>
                    <th>File : </th>
                    <td>
                        <p align="center"><img src="{{asset('uploads/'.$row->file) }}" alt="file" width="25px"></p>
                    </td>
                </tr>

                <tr id="comments_single_tr_td" style="display: none;">
                    <th>Comments: <span style="color: red;">Required</span></th>
                    <td>
                        <textarea name="" id="comment_single_{{ $row->id }}" style="width: 100%;">{{ $row->comments }}</textarea>
                    </td>
                </tr>

                @if($row->comments != '')
                    <tr>
                        <th>Comments : </th>
                        <td>
                           {!! $row->comments  !!}
                        </td>
                    </tr>

                    @else
                    <th>Comments : </th>
                    <td><p>NA</p></td>
                @endif

            </table>
        </div>
    </div>

@endsection

@section('script')
    <script>
        {{--Function  to update  a single expense --}}
        function changestatussingle(expense_id)
        {
          var commentbox =  $("#comment_single_"+expense_id).val();
          var newstatus =   $("#expense_status_"+expense_id).val();

          if (newstatus == 'Denied' )
          {
           //sending ajax request yo update of single
              if (commentbox == '')
              {
                  //Show the comments box
                  $("#comments_single_tr_td").slideDown('slow')
              }else {
                  //Comment box is not empty
                  commentbox = $("#comment_single_"+expense_id).val();
                  //send to database
                  $.post("/expenses/updatestatus",{status:newstatus, comments:commentbox,id:expense_id, _token:'{!! csrf_token() !!}'}).done(function(data) {
                      //Request Succcessful
                      location.reload();
                  });
              }
          }else {
              //url web
              $.post("/expenses/updatestatus",{status:newstatus, comments:commentbox, id:expense_id, _token:'{!! csrf_token() !!}'}).done(function(data) {
                  //Request Succcessful
                  location.reload();
              });
          }
        }
    </script>

@endsection

{{--.row>.col-sm-10.col-sm-offset-1>table.table.table-bordered--}}