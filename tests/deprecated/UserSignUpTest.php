<?php

use App\Attendize\Utils;

class UserSignUpTest extends TestCase
{
    /**
     * Test sign up page is successful
     */
    public function test_signup_is_successful(): void
    {
        $this->visit(route('showSignup'))
            ->type($this->faker->firstName(), 'first_name')
            ->type($this->faker->lastName(), 'last_name')
            ->type($this->faker->email(), 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation');

        // Add checkbox submission for attendize (dev/cloud) only
        if (Utils::isAttendize()) {
            $this->check('terms_agreed');
        }

        $this->press('Sign Up')
            ->seePageIs(route('login'));

        // TODO: Test User Details are correct
    }

    /**
     * Test sign up page is unsuccessful
     */
    public function test_signup_is_unsuccessful_because_of_no_values(): void
    {
        $this->visit(route('showSignup'))
            ->press('Sign Up')
            ->seePageIs(route('showSignup'));
    }

    /**
     * Test sign up page is unsuccessful
     */
    public function test_signup_is_unsuccessful_because_of_invalid_email(): void
    {
        $this->visit(route('showSignup'))
            ->type($this->faker->firstName(), 'first_name')
            ->type($this->faker->lastName(), 'last_name')
            ->type('test@test', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Sign Up')
            ->seePageIs(route('showSignup'));
    }

    /**
     * Test sign up page is unsuccessful
     */
    public function test_signup_is_unsuccessful_because_of_unmatched_password(): void
    {
        $this->visit(route('showSignup'))
            ->type($this->faker->firstName(), 'first_name')
            ->type($this->faker->lastName(), 'last_name')
            ->type($this->faker->email(), 'email')
            ->type('password', 'password')
            ->type('incorrect_matching', 'password_confirmation')
            ->press('Sign Up')
            ->seePageIs(route('showSignup'));
    }
}
