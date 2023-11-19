<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class DatabaseController extends MeetingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Events::paginate(10);

        return view('meeting', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'string'],
            'startDateTime' => ['required'],
            'endDateTime' => ['required'],
            'attendees' => ['required', 'array'],
        ]);

        $events = new Events();

        // this function is extended from MeetingsController to also create event on google calendar
        $event_id = $this->createEvent($request);

        $events->create([
            'event_id' => $event_id,
            'subject' => $request->subject,
            'startDateTime' => $request->startDateTime,
            'endDateTime' => $request->endDateTime,
            'attendees' => $request->attendees,
        ]);

        return redirect()->route('calendar.events')->with('created', 'Event has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Events::findOrFail($id);

        return view('editMeeting', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => ['required', 'string'],
            'startDateTime' => ['required'],
            'endDateTime' => ['required'],
            'attendees' => ['required', 'array'],
        ]);

        $events = new Events();

        $updateEvent = $events->findOrFail($id);

        // this function is extended from MeetingsController to also update event on google calendar
        $updated_event_id = $this->updateEvent($request, $updateEvent->event_id);

        $updateEvent->update([
            'event_id' => $updated_event_id,
            'subject' => $request->subject,
            'startDateTime' => $request->startDateTime,
            'endDateTime' => $request->endDateTime,
            'attendees' => $request->attendees,
        ]);

        return redirect()->route('calendar.events')->with('updated', 'Event has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = new Events();

        $delete = $event->findOrFail($id);

        // this function is extended from MeetingsController to also delete event on google calendar
        $this->destroyEvent($delete->event_id);

        $delete->delete();

        return redirect()->route('calendar.events')->with('deleted', 'Event has been deleted');
    }
}
