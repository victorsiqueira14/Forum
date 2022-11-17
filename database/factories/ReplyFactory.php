<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Thread;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userIds = User::all()->pluck('id');
        $threadIds = Thread::all()->pluck('id');

        return [
           'user_id' => fake()->randomElement($userIds),
           'thread_id' => fake()->randomElement($userIds),
           'body' => fake()->paragraph,
        ];
    }
}
