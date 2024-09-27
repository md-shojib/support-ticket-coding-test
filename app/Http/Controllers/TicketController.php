<?php
namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketOpened;
use App\Mail\TicketClosed;

class TicketController extends Controller
{
    public function dashboard()
    {
        // Fetch tickets for the authenticated user
        $tickets = Ticket::all();
        return view('auth.dashboard', compact('tickets'));
    }
    public function welcome()
    {
        // Fetch tickets for the authenticated user
        $tickets = Ticket::all();
        return view('welcome', compact('tickets'));
    }
    public function index()
    {
        // Fetch tickets for the authenticated user
        $tickets = Ticket::where('user_id', Auth::id())->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'issue' => 'required|string|max:255',
        ]);

        // Create a new ticket
        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'issue' => $request->issue,
        ]);

        // Send email notification to admin
        Mail::to('shojibcse528@gmail.com')->send(new TicketOpened($ticket));

        return redirect()->route('tickets.index')->with('success', 'Ticket opened successfully!');
    }

    public function show($id)
    {
        $ticket = Ticket::with('responses.admin')->findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    public function close($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update(['status' => 'closed']);

        // Send email notification to the customer
        Mail::to($ticket->user->email)->send(new TicketClosed($ticket));

        return redirect()->route('tickets.index')->with('success', 'Ticket closed successfully!');
    }
}
