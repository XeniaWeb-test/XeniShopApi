<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * The name of factory's corresponding model.
     *
     *@var string
     */
    protected $model = Invoice::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = $this->faker->randomElement( ['Billed', 'Paid', 'Void']);

        return [
            'customer_id' => Customer::factory(),
            'amount' => $this->faker->numberBetween(100, 20000),
            'status' => $status,
            'billed_at' => $this->faker->dateTimeThisDecade(),
            'paid_at' => $status == 'Paid' ? $this->faker->dateTimeThisDecade() : null,
        ];
    }
}
