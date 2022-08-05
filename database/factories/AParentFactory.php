<?php

namespace Database\Factories;

use App\Models\AParent;
use Illuminate\Database\Eloquent\Factories\Factory;

class AParentFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = AParent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }


}
