<?php
namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function store(Request $request, $ticketId)
    {
        // Validate request
        $request->validate([
            'response' => 'required|string',
        ]);

        // Create a new response
        Response::create([
            'ticket_id' => $ticketId,
            'admin_id' => Auth::id(), // Assuming the admin is logged in
            'response' => $request->response,
        ]);

        return redirect()->route('tickets.show', $ticketId)->with('success', 'Response added successfully!');
    }
}
