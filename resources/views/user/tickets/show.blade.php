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
                <input placeholder="{{old('subject')}}" class="form-control" name="subject" required type="text">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" class="form-control" name="message" required rows="2" placeholder="{{ old('message') }}"></textarea>
            </div>
            <div class="form-group">
                <label for="">File </label>
                <input class="form-control" name="file" required type="file">
            </div>
            <div class="form-group">
                <label for="comment">Comments</label>
                <textarea id="comment" class="form-control" name="comment" rows="3" placeholder="{{ old('comment') }}"></textarea>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-success">Leave comment</button>
                <form method="POST" action="{{route('user.tickets.destroy', $ticket->id)}}">
                    @csrf
                    <button class="dropdown-item" type="submit"><i class="fa fa-trash"></i>Close ticket</button>
                </form>
            </div>
        </form>
    </div>
</div>
@endsection
