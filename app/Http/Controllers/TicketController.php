<?php

namespace App\Http\Controllers;

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
}
