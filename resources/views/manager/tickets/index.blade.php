@extends('layouts.manager', ['title' =>'View all tickets'])
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex flex-row">
            <h6 class="m-2 font-weight-bold text-primary">
                Tickets
            </h6>
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Sort by:
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background-color: bisque;">
                  <a class="dropdown-item" href="{{ route('manager.ticket.sort', $status='viewed' ) }}"><i style='font-size:18px' class='fas'>&#xf06e;</i>  Viewed</a>
                  <a class="dropdown-item" href="{{ route('manager.ticket.sort', $status='new' ) }}"><i style='font-size:18px' class='fas'>&#xf070;</i> Not viewed</a>
                  <hr>
                  <a class="dropdown-item" href="{{ route('manager.ticket.sort', $status='open' ) }}"><i style='font-size:18px' class='fas'>&#xf3c1;</i> Open</a>
                  <a class="dropdown-item" href="{{ route('manager.ticket.sort', $status='closed' ) }}"><i style='font-size:18px' class='fas'>&#xf023;</i> Close</a>
                  <hr>
                  <a class="dropdown-item" href="{{ route('manager.ticket.sort', $status='answered' ) }}"><i style='font-size:18px' class="fas fa-comment"></i> Answered</a>
                  <a class="dropdown-item" href="{{ route('manager.ticket.sort', $status='pending' ) }}"><i style='font-size:18px' class="fas fa-comment-slash"></i> Not answered</a>
                </div>
            </div>

        </div>
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
                                <a href="{{ route('manager.tickets.show', $ticket->slug ) }}" class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <form action="{{route('manager.ticket.solve', $ticket->slug)}}">
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
