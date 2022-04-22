<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index()
    {
        return view('services.index', ['services' => Service::paginate(5)]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'entitled' => 'required|string|min:5|max:20|unique:services,entitled',
        ]);

        Service::create([
            'entitled' => $request->entitled
        ]);

        return back();
    }
}
