<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class EventPromoteController extends MyBaseController
{
    /**
     * @return mixed
     */
    public function showPromote($event_id): View
    {
        $data = [
            'event' => Event::scope()->find($event_id),
        ];

        return view('ManageEvent.Promote', $data);
    }
}
