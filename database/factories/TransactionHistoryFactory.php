<?php

namespace Database\Factories;

use App\Models\TransactionHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionHistoryFactory extends Factory
{
    protected $model = TransactionHistory::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'buySell' => $this->faker->randomElement(['buy', 'sell']),
            'amount' => $this->faker->randomFloat(8, 0, 1000),
            'rate' => $this->faker->randomFloat(8, 0, 1000)
        ];
    }
}
