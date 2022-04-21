<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'ticket_id' => 'required|integer|exists:tickets,id',
            'content' => 'required|string|min:10|max:255',
        ]);
        // dd($request->all());
        $ticket = Ticket::findOrFail($request->ticket_id);
        $ticket->answers()->create([
            'content' => $request->content,
            'user_id' => auth()->user()->id,
        ]);

        return back();
    }
}
