<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    //  'title',
    //     'body',
    //     'user_id'
    public function definition()
    {
        return [
            'title'     => $this->faker->sentence(),
            'body'      => $this->faker->text(),
            'user_id'   => User::all()->random()->id,
        ];
    }
}
