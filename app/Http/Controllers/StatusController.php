<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    
    public function index()
    {
        return view('statuses.index', ['statuses' => Status::paginate(5)]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'entitled' => 'required|string|min:2|max:20|unique:statuses,entitled',
        ]);

        Status::create([
            'entitled' => $request->entitled
        ]);

        return back();
    }
}
