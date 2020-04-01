@extends('layouts.user', ['title' =>'Show tickets'])
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Tickets
            <a class="btn btn-sm btn-primary float-right" href="{{route('user.tickets.create')}}">Add</a>
        </h6>
    </div>
    <div class="card-body">
        @include('layouts.alerts.main')
        <table class="table table-bordered">
            <thead>
                <th>#</th>
                <th>Subject</th>
                <th>Created at</th>
                <th>Status</th>
                <th width="120px">Actions</th>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ $ticket->created_at }}</td>
                    <td >{{ $ticket->status }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="row">
                                <a href="{{ route('user.tickets.show', $ticket->id ) }}" class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <form method="GET" action="{{route('user.ticket.close', $ticket->id)}}">
                                        @csrf
                                        <button class="dropdown-item" style="color:red;" type="submit"><i class="fa fa-trash"></i>Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$tickets->links()}}
    </div>
</div>
@endsection
