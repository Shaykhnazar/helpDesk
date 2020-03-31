@extends('layouts.user', ['title' =>'Create ticket'])
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Add ticket
        </h6>
    </div>
    <div class="card-body">
        @include('layouts.alerts.main')
        <form method="POST" enctype="multipart/form-data" action="{{ route('user.tickets.store') }}">
            @csrf
            <div class="form-group">
                <label for="">Subject <span class="text-danger">*</span></label>
                <input value="{{old('subject')}}" class="form-control" name="subject" required type="text">
            </div>
            <div class="form-group">
                <label for="message">Message <span class="text-danger">*</span></label>
                <textarea id="message" class="form-control" name="message" required rows="3">{{ old('message') }}</textarea>
            </div>
            <div class="form-group">
                <label for="">File <span class="text-danger">*</span></label>
                <input class="form-control" name="file" required type="file">
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection
