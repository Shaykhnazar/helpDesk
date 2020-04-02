@extends('layouts.manager', ['title' =>'Answer to ticket'])
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Show ticket <i style="color:red"> ID: {{ $ticket->id }}</i>
        </h6>
        <a class="btn btn-sm btn-primary float-right" href="{{route('manager.tickets.index')}}">Back</a>
    </div>
    <div class="card-body">
        @include('layouts.alerts.main')
        <div class="jumbotron jumbotron">
            <h1 class="display-4">{{ $ticket->subject }}</h1>
            <hr class="my-4">
            <p>{{ $ticket->message }}</p>
        </div>
        @isset($ticket->thumb)
            <p>
                <img class="card-img-bottom" style="width:150px;" src="{{ '/storage/'.$ticket->thumb }}" alt="">
            </p>
        @endisset
        {{-- @if (isset($ticket->file) && extension($ticket->file) == 'txt')
            <a href="{{ '/storage/'.$ticket->file }}" target="_blank">file</a>
        @endif --}}
        @isset($comments)
        <p>All Comments</p>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    @foreach ($comments as $comment)
                        <div class="card card-white post">
                            <div class="post-heading">
                                <div class="float-left image">
                                    <img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar" alt="user profile image">
                                </div>
                                <div class="float-left meta">
                                    <div class="title h5">
                                        <a href="#"><b>{{ ($comment->users->role == App\User::ROLE_MANAGER) ? 'Manager' : 'User' }}</b></a>
                                        made a post.
                                    </div>
                                    <h6 class="text-muted time">{{ (date_format($comment->created_at, 'Y-m-d H:i:s')) }}</h6>
                                </div>
                            </div>
                            <div class="post-description">
                                <p>
                                    {{ $comment->text }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endisset
        <hr>
        <form method="POST" action="{{ route('manager.ticket.post.comment', $ticket->id) }}">
            @csrf
            <div class="form-group">
                <textarea id="comment" class="form-control" name="comment" rows="3" placeholder="Type comment..."></textarea>
            </div>
            <button type="submit" class="btn btn-success mb-2"><i class="fas fa-paper-plane"></i> Leave comment</button>
        </form>
        <div class="row p-2" style="float:right;">
            <form action="{{route('manager.ticket.solve', $ticket->id)}}" >
                @csrf
                <button class="btn btn-warning mb-2" type="submit"><i class="fa fa-trash"></i> Solve ticket</button>
            </form>
        </div>
    </div>
</div>
@endsection
