<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Illuminate\Support\Str;

class GoogleCalendarController extends Controller
{
    public $client;

    // public $start;
    // public $end;
    // public $meetingId;

    public function __construct()
    {
        $client = new Client();

        $client->setApplicationName("Cognimeet");
        $client->setRedirectUri("http://127.0.0.1:8000/dashboard");

        $client->setScopes(Calendar::CALENDAR);
        $client->setAuthConfig(storage_path("app/google-calendar/oauth-credentials.json"));
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        if (file_exists(storage_path("app/google-calendar/oauth-token.json"))) {
            $accessToken = json_decode(file_get_contents(storage_path("app/google-calendar/oauth-token.json")), true);
            $client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname(storage_path("app/google-calendar/oauth-token.json")))) {
                mkdir(dirname(storage_path("app/google-calendar/oauth-token.json")), 0700, true);
            }
            file_put_contents(storage_path("app/google-calendar/oauth-token.json"), json_encode($client->getAccessToken()));
        }

        // return redirect()->route('Calendar.index', compact('googleClient'));
        $this->client = $client;
        // dd($this->client);
        // exit();
    }

    public function createMeeting(Request $request)
    {
        $start = Carbon::now();
        $end = Carbon::now()->addMinutes(10);

        $service = new Calendar($this->client);

        $event = new Event(array(
            'summary' => 'my meeting',
            'start' => array(
                'dateTime' => $start->format(\DateTime::RFC3339),
                'timeZone' => 'Asia/Bangkok',
            ),
            'end' => array(
                'dateTime' => $end->format(\DateTime::RFC3339),
                'timeZone' => 'Asia/Bangkok',
            ),
        ));

        $event = $service->events->insert("primary", $event);

        $conference = new \Google\Service\Calendar\ConferenceData();
        $conferenceRequest = new \Google\Service\Calendar\CreateConferenceRequest();
        $conferenceRequest->setRequestId(Str::orderedUuid());
        $conference->setCreateRequest($conferenceRequest);
        $event->setConferenceData($conference);

        $event = $service->events->patch("primary", $event->id, $event, ['conferenceDataVersion' => 1]);

        return view('dashboard', compact('event'))
        ->with('created', 'Meeting Event has been created!');
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
