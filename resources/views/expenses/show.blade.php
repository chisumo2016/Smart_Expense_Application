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

                @if($row->comments != '')

                    <tr>
                        <th>Comments : </th>
                        <td>
                           {{ $row->comments }}
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

{{--.row>.col-sm-10.col-sm-offset-1>table.table.table-bordered--}}