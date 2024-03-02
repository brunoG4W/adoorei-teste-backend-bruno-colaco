<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Product;
use App\Models\Sale;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [            
            'amount' => 0.00,
        ];
    }



    public function configure()
    {
        return $this->afterCreating(function (Sale $sale) {
            $sum = $sale->products->sum(function ($item) {
                return $item['price'];
            });
            $sale->amount = $sum;      
        });
    }


}
