<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class EventViewEmbeddedController extends Controller
{
    /**
     * Show an embedded version of the event page
     */
    public function showEmbeddedEvent($event_id): View
    {
        $event = Event::findOrFail($event_id);

        $data = [
            'event' => $event,
            'tickets' => $event->tickets()->where('is_hidden', 0)->orderBy('sort_order', 'asc')->get(),
            'is_embedded' => '1',
        ];

        return view('Public.ViewEvent.Embedded.EventPage', $data);
    }
}
