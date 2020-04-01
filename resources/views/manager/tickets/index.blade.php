@extends('layouts.manager', ['title' =>'View all tickets'])
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Tickets
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
                <th width="100px">Actions</th>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ $ticket->created_at }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="row">
                                <a href="{{ route('manager.tickets.edit', $ticket->id ) }}" class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <form action="{{route('manager.ticket.solve', $ticket->id)}}">
                                        @csrf
                                        <button class="dropdown-item" style="color:red;" type="submit"><i class="fa fa-trash"></i>Solve</button>
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
