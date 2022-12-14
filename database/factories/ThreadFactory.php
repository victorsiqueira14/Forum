<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Channel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userIds = User::all()->pluck('id');
        $channelIds = Channel::all()->pluck('id');
        $slug = Channel::all()->pluck('slug');

        return [
           'user_id' => fake()->randomElement($userIds),
           'channel_id' => fake()->randomElement($userIds),
           'title' => fake()->sentence,
           'body' => fake()->paragraph,
        ];
    }
}
