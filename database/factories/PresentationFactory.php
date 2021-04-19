<?php

namespace Database\Factories;

use App\Models\Presentation;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PresentationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Presentation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'user_id' => User::all()->random()->id,
            'link' => $this->faker->unique()->regexify('[A-Za-z0-9]{20}'),
            'has_password' => false,
            'password' => null,

        ];
    }
}
