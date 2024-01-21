<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentGatewayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'provider_name' => $this->faker->company(),
            'provider_url' => $this->faker->url(),
            'is_on_site' => $this->faker->boolean(),
            'can_refund' => $this->faker->boolean(),
            'name' => $this->faker->company(),
            'default' => $this->faker->boolean(),
            'admin_blade_template' => '',
            'checkout_blade_template' => '',
        ];
    }

    public function dummy()
    {
        return $this->state(['provider_name' => 'Dummy/Test Gateway', 'provider_url' => 'none', 'is_on_site' => 1, 'can_refund' => 1, 'name' => 'Dummy', 'default' => 1, 'admin_blade_template' => '', 'checkout_blade_template' => 'Public.ViewEvent.Partials.Dummy']);
    }

    public function stripe()
    {
        return $this->state(['name' => 'Stripe', 'provider_name' => 'Stripe', 'provider_url' => 'https://www.stripe.com', 'is_on_site' => 1, 'can_refund' => 1, 'default' => 0, 'admin_blade_template' => 'ManageAccount.Partials.Stripe', 'checkout_blade_template' => 'Public.ViewEvent.Partials.PaymentStripe']);
    }

    public function stripeSCA()
    {
        return $this->state(['provider_name' => 'Stripe SCA', 'provider_url' => 'https://www.stripe.com', 'is_on_site' => 0, 'can_refund' => 1, 'name' => 'Stripe\\PaymentIntents', 'default' => 0, 'admin_blade_template' => 'ManageAccount.Partials.StripeSCA', 'checkout_blade_template' => 'Public.ViewEvent.Partials.PaymentStripeSCA']);
    }
}
