<?php

class OrganiserEventsTest extends TestCase
{
    public function test_show_events_displays_events(): void
    {
        $organiser = \App\Models\Organiser::factory()->create(['account_id' => 1]);

        $event1 = \App\Models\Event::factory()->create([
            'account_id' => $organiser->account_id,
            'organiser_id' => $organiser->id,
            'user_id' => $this->test_user->id,
        ]);

        $event2 = \App\Models\Event::factory()->create([
            'account_id' => $organiser->account_id,
            'organiser_id' => $organiser->id,
            'user_id' => $this->test_user->id,
        ]);

        $this->actingAs($this->test_user)
            ->visit(route('showOrganiserEvents', ['organiser_id' => $organiser->id]))
            ->see($event1->title)
            ->see($event2->title)
            ->see('2 events');
    }
}
