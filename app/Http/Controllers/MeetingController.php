<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;

class MeetingController extends Controller
{
    public $client;

    public function __construct()
    {
        $client = new Client(); // Google Client

        $service_account_token = base_path('/app/Credentials/meeting-credentials.json');

        $client->setAuthConfig($service_account_token);
        $client->setScopes(Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
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
     * @return int event_id
     */
    public function createEvent(Request $request)
    {
        $service_calender = new Calendar($this->client);  // Google Service Calendar

        $event_calender = new Event([ // Google Service Calendar Event
            'summary' => $request->subject,
            'start' => [
                'dateTime' => $request->startDateTime.':00',
                'timeZone' => 'Asia/Karachi',
            ],
            'end' => [
                'dateTime' => $request->endDateTime.':00',
                'timeZone' => 'Asia/Karachi',
            ],
            // 'attendees' => [
            //     ['email' => $request->attendees[0]],
            //     ['email' => $request->attendees[1]],
            // ],
            // 'maxAttendees' => 2,
        ]);

        /**
         * Calendar id set to my gmail account.
         */
        $calender_id = config('app.google_calendar_id');

        $event = $service_calender->events->insert($calender_id, $event_calender);

        $event_id = $event->getId();

        return $event_id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @return int updated_event_id
     */
    public function updateEvent(Request $request, $id)
    {
        $service_calender = new Calendar($this->client);  // Google Service Calendar

        $event_calender = new Event([ // Google Service Calendar Event
            'summary' => $request->subject,
            'start' => [
                'dateTime' => $request->startDateTime.':00',
                'timeZone' => 'Asia/Karachi',
            ],
            'end' => [
                'dateTime' => $request->endDateTime.':00',
                'timeZone' => 'Asia/Karachi',
            ],
            // 'attendees' => [
            //     ['email' => $request->attendees[0]],
            //     ['email' => $request->attendees[1]],
            // ],
            // 'maxAttendees' => 2,
        ]);

        /**
         * Calendar id set to my gmail account.
         */
        $calender_id = config('app.google_calendar_id');

        $update_event = $service_calender->events->update($calender_id, $id, $event_calender);

        $updated_event_id = $update_event->getId();

        return $updated_event_id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyEvent($deleted_event_id)
    {
        $service_calender = new Calendar($this->client);  // Google Service Calendar

        $calender_id = config('app.google_calendar_id');

        $service_calender->events->delete($calender_id, $deleted_event_id);
    }
}
