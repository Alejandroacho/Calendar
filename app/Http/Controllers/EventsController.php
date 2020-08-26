<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
    public function index()
    {
        return view("events.index");
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $eventData=request()->except(['_token', '_method']);
        Event::create($eventData);
        print_r($eventData);
    }

    public function show($id)
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
