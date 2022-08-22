<?php

namespace Database\Factories;

use App\Models\Request;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = (bool) rand(0, 1);

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->email(),
            'status' => $status ? Request::STATUS_RESOLVED : Request::STATUS_ACTIVE,
            'message' => fake()->text(rand(150, 200)),
            'comment' => $status ? fake()->text(rand(150, 200)) : null
        ];
    }
}
