<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Event;
use Illuminate\Http\Request;

/*
  Attendize.com   - Event Management & Ticketing
 */

class EventWidgetsController extends MyBaseController
{
    /**
     * Show the event widgets page
     */
    public function showEventWidgets(Request $request, $event_id): View
    {
        $event = Event::scope()->findOrFail($event_id);

        $data = [
            'event' => $event,
        ];

        return view('ManageEvent.Widgets', $data);
    }
}
