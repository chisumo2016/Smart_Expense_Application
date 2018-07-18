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
                  @if(count($categories) > 0)
                   @foreach($categories as $category)
                          <a href="" style="display: block">
                              <div class="departs-group-budget">
                                  <p>{{ $category->name }}</p>
                                  <p>Exp total / Bdgt total</p>
                                  <p>spend</p>
                              </div>
                          </a>
                    @endforeach
                  @endif
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
                            @if(count($budgets) > 0)
                            @foreach($budgets as $row)
                            <tr>
                                <td class="request-budget">
                                    <h5>{{ $row->item }}</h5>
                                    <p> Created: <span>{{ date('d-M-Y',strtotime($row->created_at)) }}</span></p>
                                    <p>{{ $row->name }}</p>
                                </td>
                                <td class="amount">{{  \App\Providers\Common::format_currency($row->unit) }}</td>
                                <td class="approvers">{{ $row->quantity }}</td>
                                <td class="details">{{  \App\Providers\Common::format_currency($row->budget) }}</td>
                            </tr>
                             @endforeach
                             @endif
                            </tbody>
                        </table>
                    </div><!-- end  budget-table class-->

                    @if(count($budgets) > 0)
                    <div class="total-thing col-sm-12">
                        <div class="title col-sm-5">Budget Information</div>
                            <div class="details col-sm-5 pull-right">
                                <p>Total Budgets &nbsp;&nbsp;<span>Total Budgets</span></p>
                                <p>Spend From  Budgets &nbsp;&nbsp;<span>Total Budgets</span></p>
                                <p>Remaining  Budget &nbsp;&nbsp;<span>Remaining Budgets</span></p>
                            </div>

                    </div>
                    @else
                    <h4 align="center">No Item Found</h4>

                   @endif
                </div>
            </div>  <!-- end row-->
        </div>  <!-- end col -12-->
    </div> <!-- end row-->




@endsection

{{--.row>.col-sm-12--}}
{{--table.table.table-bordered>thead(tr>th*4)+tbody(tr>td*4)--}}
{{--table.table.table-bordered>thead(tr>th*4.tbl-heading)+tbody(tr>td*4)--}}

{{--.total-thing.col-sm-12>.title.col-sm-5>.details.col-sm-5.pull-right>p*3--}}


{{--a>div.departs-group-budget>p*3--}}