@extends('layouts.manager', ['title' =>'Answer to ticket'])
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Show ticket
        </h6>
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
        <form method="POST" action="{{ route('manager.tickets.update', $ticket->id) }}">
            @csrf
            <div class="form-group">
                <label for="comment">Comments</label>
                <textarea id="comment" class="form-control" name="comment" rows="3" placeholder="{{ old('comment') }}"></textarea>
            </div>
            <button type="submit" class="btn btn-success mb-2"><i class="fas fa-paper-plane"></i> Leave comment</button>
        </form>
        <div class="row p-2" style="float:right;">
            <form method="POST" action="{{route('manager.tickets.destroy', $ticket->id)}}" >
                @csrf
                <button class="btn btn-warning mb-2" type="submit"><i class="fa fa-trash"></i> Solve ticket</button>
            </form>
        </div>
    </div>
</div>
@endsection
