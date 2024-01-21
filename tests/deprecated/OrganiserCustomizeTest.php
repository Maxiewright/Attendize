<?php

class OrganiserCustomizeTest extends TestCase
{
    /**
     * @group passing
     */
    public function test_customize_organiser_is_successful()
    {
        $organiser = \App\Models\Organiser::factory()->create();

        $this->actingAs($organiser)
            ->visit(route('showOrganiserCustomize', ['organiser_id' => $organiser->id]))
            ->type($this->faker->name(), 'name')
            ->type($this->faker->email(), 'email')
            ->type($this->faker->word(), 'facebook')
            ->type($this->faker->word(), 'twitter')
            ->press('Save Organiser')
            ->seeJson([
                'status' => 'success',
            ]);
    }
}
