@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-2">
                    <h2 style="color: #000000; text-align: center;">Budgets</h2>
                </div>

                <div class="col-sm-3" style="margin-top: 22px; text-decoration: none;">
                    <a href="{{ route('budget.index') }}">
                        <button class="btn btn-default btn-block">List All &nbsp; <i class="fa fa-list"></i></button>
                    </a>
                </div>

                <div class="col-sm-3" style="margin-top: 22px; text-decoration: none;">
                    <a href="{{ route('budget.create') }}">
                        <button class="btn btn-primary btn-block">Add New Budget &nbsp; <i class="fa fa-plus"></i></button>
                    </a>
                </div>

                <div class="col-sm-4" style="margin-top: 22px;">
                    <div class="dropdown">
                        <select class="form-control">
                            <option value="all">Choose Budget Period</option>
                            @if(count($periods) > 0)
                                @foreach($periods as $row)
                                    <option value="">{{ \App\Providers\Common::formatDate($row->from) }} to {{ \App\Providers\Common::formatDate($row->to) }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>


            </div>

            <div class="row">
              <div class="col-sm-2 sidebar">
                  <h2>Category</h2>
              </div>

                <hr>
                <div class="col-sm-10">
                    <div class="budget-table">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="tbl-heading">Budget Item</th>
                                <th class="tbl-heading">Unit</th>
                                <th class="tbl-heading">Quantity</th>
                                <th class="tbl-heading">Budget</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="request-budget">
                                    <h5></h5>
                                    <p></p>
                                    <p></p>
                                </td>
                                <td class="amount"></td>
                                <td class="approvers"></td>
                                <td class="details"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- end  budget-table class-->

                    <div class="total-thing col-sm-12">
                        <div class="title col-sm-5">
                            <div class="details col-sm-5 pull-right">
                                <p><span></span></p>
                                <p><span></span></p>
                                <p><span></span></p>
                            </div>
                        </div>
                    </div>

                    <h4 align="center">No Item Found</h4>
                </div>
            </div>  <!-- end row-->
        </div>  <!-- end col -12-->
    </div> <!-- end row-->




@endsection

{{--.row>.col-sm-12--}}
{{--table.table.table-bordered>thead(tr>th*4)+tbody(tr>td*4)--}}
{{--table.table.table-bordered>thead(tr>th*4.tbl-heading)+tbody(tr>td*4)--}}

{{--.total-thing.col-sm-12>.title.col-sm-5>.details.col-sm-5.pull-right>p*3--}}