@extends('tickets.app')

@section('content')
<div class="container">
    <h2>Your Tickets</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Issue</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->issue }}</td>
                    <td>{{ ucfirst($ticket->status) }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info">View</a>
                        @if($ticket->status === 'open')
                            <form action="{{ route('tickets.close', $ticket->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Close</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
