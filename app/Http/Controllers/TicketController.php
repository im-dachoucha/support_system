<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Service;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class TicketController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user')->only('create', 'store', 'status');
    }

    public function index()
    {
        if(Blade::check('admin')){
            return view('tickets.index', ["tickets" => Ticket::orderby('created_at', 'desc')->paginate(5)]);
        }
        return view('tickets.index', ["tickets" => Ticket::where('user_id', auth()->user()->id)->orderby('created_at', 'desc')->paginate(5)]);
        // return view('tickets.index', ["tickets" => auth()->user()->tickets]);
    }

    public function create(){
        return view('tickets.create', ['services' => Service::all()]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|string|min:5|max:255',
            'content' => 'required|string|min:10|max:255',
            'service' => 'required|integer|exists:services,id',
        ]);

        $ticket = Ticket::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'service_id' => $request->service,
            'status_id' => 1,
        ]);

        return redirect()->route('tickets.index');
    }

    public function answer($ticket_id){
        $ticket = Ticket::findOrFail($ticket_id);
        $answers = Answer::where("ticket_id", $ticket_id)->paginate(5);
        return view('tickets.answer', ['ticket' => $ticket, 'answers' => $answers]);
    }

    public function status(Request $request, $ticket_id){
        $this->validate(request(), [
            'status_id' => 'required|integer|exists:statuses,id',
        ]);
        $ticket = Ticket::findOrFail($ticket_id);
        $ticket->status_id = $request->status_id;
        $ticket->save();
        return redirect()->route('tickets.index');
    }
}
