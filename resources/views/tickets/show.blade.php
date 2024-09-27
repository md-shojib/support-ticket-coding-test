@extends('tickets.app')

@section('content')
<div class="container">
    <h2>Ticket Details</h2>
    <p><strong>Issue:</strong> {{ $ticket->issue }}</p>
    <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>

    <h3>Responses</h3>
    @foreach ($ticket->responses as $response)
        <div class="card mb-2">
            <div class="card-body">
                <strong>Admin:</strong> {{ $response->admin->name }}<br>
                <p>{{ $response->response }}</p>
            </div>
        </div>
    @endforeach

    @if($ticket->status === 'open')
        <h3>Add Response</h3>
        <form method="POST" action="{{ route('responses.store', $ticket->id) }}">
            @csrf
            <div class="form-group">
                <textarea name="response" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Response</button>
        </form>
    @endif
</div>
@endsection
