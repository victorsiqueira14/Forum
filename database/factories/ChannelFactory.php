<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
            $name = fake()->word;

            return [
                'name' => $name,
                'slug' => Str::slug($name),
        ];
    }
}
