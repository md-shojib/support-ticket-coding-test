@extends('tickets.app')

@section('content')
<div class="container">
    <h2>Create a Ticket</h2>
    <form method="POST" action="{{ route('tickets.store') }}">
        @csrf
        <div class="form-group">
            <label for="issue">Issue</label>
            <textarea name="issue" id="issue" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Ticket</button>
    </form>
</div>
@endsection
