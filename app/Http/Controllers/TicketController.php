<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class TicketController extends Controller
{
    public function index()
    {
        if(Blade::check('admin')){
            return view('tickets.index', ["tickets" => Ticket::get(1)]);
        }
        // return view('tickets.index', ["tickets" => Ticket::where('user_id', auth()->user()->id)->paginate(1)]);
        return view('tickets.index', ["tickets" => auth()->user()->tickets]);
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
}
