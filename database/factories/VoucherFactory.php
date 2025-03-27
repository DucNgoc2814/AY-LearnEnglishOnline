<?php

namespace Database\Factories;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoucherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Voucher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startDate = $this->faker->dateTimeBetween('-30 days', '+30 days');
        $endDate = $this->faker->dateTimeBetween($startDate, '+90 days');
        $maxUsage = $this->faker->boolean(70) ? $this->faker->numberBetween(1, 100) : null;
        
        return [
            'code' => strtoupper($this->faker->bothify('??##??##')),
            'sale' => $this->faker->numberBetween(5, 50),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'usage_count' => $this->faker->numberBetween(0, $maxUsage ?: 10),
            'max_usage' => $maxUsage,
            'min_order_value' => $this->faker->boolean(60) ? $this->faker->numberBetween(10000, 100000) : null,
            'max_discount' => $this->faker->boolean(40) ? $this->faker->numberBetween(20000, 200000) : null,
        ];
    }
} 