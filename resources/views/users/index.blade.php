@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-sm-8">
                <h2>All Users </h2>
            </div>
            <div class="col-sm-4" style="margin-top: 22px;">
                <a href="{{ route('user.create') }}">
                    <button class="btn btn-primary btn-block">Add Users &nbsp; <i class="fa fa-plus"></i></button>
                </a>
            </div>
        </div>
    </div>

    <hr>

    <div class="row" style="margin-top:  100px;">
        <div class="col-sm-8 col-sm-offset-2">

        </div>
    </div>


    <div class="row">

            <div class="col-sm-8 col-offset-2">
                <div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Role</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if(count($users) > 0)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone}}</td>
                                    <td>
                                        @if($user->status == "on")
                                            Active
                                        @else
                                            Deactive
                                        @endif
                                    </td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <a href="{{ route('user.edit',   $user->id) }}"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('user.delete', $user->id) }}" onclick="return confirm('Are you sure , you wish to proceed')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


@endsection

{{--.row>.col-sm-8.col-sm-offset-2--}}
{{--.row>.col-sm-8.col-offset-2>div>table.table.table-hover>thead(tr>th*7)+tbody(tr>td*7)--}}