<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $events = DB::select('CALL sp_read_events()');
            $error = null;
        } catch (QueryException $e) {
            \Log::error('Stored procedure error: ' . $e->getMessage());

            $events = collect();
            $error = 'Er is een fout opgetreden, probeer het later opnieuw.';
        }

        return view('events.index', compact('events', 'error'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        try {
            // Roep stored procedure aan
            DB::statement('CALL sp_create_event(?, ?, ?, ?)', [
                $request->input('title'),
                $request->input('description'),
                $request->input('date'),
                $request->input('location'),
            ]);

            return redirect()->route('events.index')->with('success', 'Event succesvol toegevoegd!');
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Fout bij SP: ' . $e->getMessage());

            // Geef foutmelding mee aan de view
            return redirect()->back()->withInput()->with('error', 'Fout bij opslaan van het event. Probeer het later opnieuw.');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
