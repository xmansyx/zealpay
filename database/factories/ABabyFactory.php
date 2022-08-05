<?php

namespace Database\Factories;

use App\Models\ABaby;
use App\Models\AParent;
use Illuminate\Database\Eloquent\Factories\Factory;

class ABabyFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = ABaby::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'parent_id' => AParent::factory()
        ];
    }


}
