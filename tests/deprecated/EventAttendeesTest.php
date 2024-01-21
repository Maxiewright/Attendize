<?php

class EventAttendeesTest extends TestCase
{
    public function test_event_attendees_are_displayed()
    {
        // Create organiser with account id = 1 to skip first run
        $organiser = \App\Models\Organiser::factory()->create([
            'account_id' => 1,
        ]);

        $event = \App\Models\Event::factory()->create([
            'account_id' => $organiser->account_id,
        ]);

        $attendee = \App\Models\Attendee::factory()->create([
            'account_id' => $organiser->account_id,
            'event_id' => $event->id,
            'first_name' => 'Test First Name',
            'last_name' => 'Test Last Name',
        ]);

        $this->actingAs($this->test_user)
            ->visit(route('showEventAttendees', ['event_id' => $attendee->event->id]))
            ->see('Attendees')
            ->see('Test First Name')
            ->see('Test Last Name');
    }
}
