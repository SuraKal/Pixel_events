<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $attendeeRole = Role::firstOrCreate(['name' => 'attendee']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        // $category = Category::firstOrCreate();

        $attendees = User::factory(3)
            ->afterCreating(fn(User $user) => $user->roles()->attach($attendeeRole->id))
            ->create();

        $admins = User::factory(1)
            ->afterCreating(fn(User $user) => $user->roles()->attach($adminRole->id))
            ->create();

        $this->createEvents('approved', $attendees, 10);
        $this->createEvents('pending', $attendees, 10);
        $this->createEvents('approved', $attendees, 3, [
            'featured' => true
        ]);
    }

    private function createEvents(string $status, $users, int $count, array $overrides = []): void
    {
        Event::factory($count)
            ->create(array_merge(['status' => $status], $overrides))
            ->each(function (Event $event) use ($users) {
                $event->attendees()->syncWithPivotValues($users->pluck('id')->toArray(), ['status' => 'registered']);
                $this->addCommentsAndImages($event, $users);
            });
    }

    private function addCommentsAndImages(Event $event, $users): void
    {
        $users->each(function (User $user) use ($event) {
            $event->comments()->create([
                'user_id' => $user->id,
                'content' => fake()->sentence(),
            ]);
            $event->images()->create([
                'image_path' => fake()->imageUrl(600, 400, 'nature'),
            ]);
        });
    }
}
