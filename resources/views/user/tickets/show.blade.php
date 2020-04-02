@extends('layouts.user', ['title' =>'My tickets'])
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Show ticket
        </h6>
        <a class="btn btn-sm btn-primary float-right" href="{{route('user.tickets.index')}}">Back</a>
    </div>
    <div class="card-body">
        @include('layouts.alerts.main')
            <div class="form-group">
                <label for="">Subject</label>
                <input placeholder="{{ $ticket->subject}}" class="form-control" name="subject"  type="text">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" class="form-control" name="message"  rows="2" placeholder="{{ $ticket->message }}"></textarea>
            </div>
            <div class="form-group">
                @isset($ticket->thumb)
                <label for="">Uploaded image </label>
                <p>
                    <img class="card-img-bottom" style="width:150px;" src="{{ '/storage/'.$ticket->thumb }}" alt="">
                </p>
                @endisset
            </div>
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
                                            <a href="#"><b>{{ ($comment->users->role == 2) ? 'Manager' : 'User' }}</b></a>
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
        <form method="POST" action="{{ route('user.ticket.post.comment', $ticket->id) }}">
            @csrf
            <div class="form-group">
                <textarea id="comment" class="form-control" name="comment" rows="3" placeholder="Type comment..."></textarea>
            </div>
            <button type="submit" class="btn btn-success mb-2"><i class="fas fa-paper-plane"></i> Leave comment</button>
        </form>
        <div class="row p-2" style="float:right;">
            <form  action="{{route('user.ticket.close', $ticket->id)}}" class="align-right">
                @csrf
                <button class="btn btn-danger mb-2" type="submit"><i class="fa fa-trash"></i> Close ticket</button>
            </form>
        </div>
    </div>
</div>
@endsection
