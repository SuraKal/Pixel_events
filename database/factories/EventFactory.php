<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' =>fake()->name,
            'description' =>fake()->text,
            'date' =>fake()->date(),
            'location' => fake()->word(),
            'user_id' => User::factory()->afterCreating(function (User $user) {
                // Attach a role to the user
                $role = Role::firstOrCreate(['name' => 'organizer']);
                $user->roles()->attach($role->id);
            }),
            'category_id' => Category::factory(),
            'status' => 'pending'
        ];
    }
}
