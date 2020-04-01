@extends('layouts.user', ['title' =>'My tickets'])
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Show ticket
        </h6>
    </div>
    <div class="card-body">
        @include('layouts.alerts.main')
        <form method="POST" action="{{ route('user.tickets.update', $ticket->id) }}">
            @csrf
            <div class="form-group">
                <label for="">Subject</label>
                <input placeholder="{{ $ticket->subject}}" class="form-control" name="subject"  type="text">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" class="form-control" name="message"  rows="2" placeholder="{{ $ticket->message }}"></textarea>
            </div>
            <div class="form-group">
                <label for="">File </label>
                <input class="form-control" name="file" value="" type="file">
                @isset($ticket->thumb)
                <p>
                    <img class="card-img-bottom" style="width:150px;" src="{{ '/storage/'.$ticket->thumb }}" alt="">
                </p>
                @endisset
            </div>
            <div class="form-group">
                <label for="comment">Comments</label>
                <textarea id="comment" class="form-control" name="comment" rows="3" placeholder="{{ old('comment') }}"></textarea>
            </div>
            <button type="submit" class="btn btn-success mb-2"><i class="fas fa-paper-plane"></i> Leave comment</button>
        </form>
        <div class="row p-2" style="float:right;">
            <form  action="{{route('user.tickets.destroy', $ticket->id)}}" class="align-right">
                @csrf
                <button class="btn btn-danger mb-2" type="submit"><i class="fa fa-trash"></i> Close ticket</button>
            </form>
        </div>
    </div>
</div>
@endsection
