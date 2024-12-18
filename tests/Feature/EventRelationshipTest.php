<?php

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\Event;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;



it('an event belongs to a user', function () {
    $user = User::factory()->create();
    $event = Event::factory()->create(['user_id' => $user->id]);

    expect($event->organizer)->toBeInstanceOf(User::class);
    expect($event->organizer->id)->toBe($user->id);
});

it('a user can have many roles', function () {
    $user = User::factory()->create();
    $roles = Role::factory(3)->create();

    $user->roles()->attach($roles);

    expect($user->roles)->toHaveCount(3);
    $user->roles->each(fn($role) => expect($role)->toBeInstanceOf(Role::class));
});


it('an event belongs to a catagory', function () {
    $category = Category::factory()->create();
    $event = Event::factory()->create([
        'category_id' => $category->id
    ]);

    expect($event->category)->toBeInstanceOf(Category::class);

    expect($event->category->id)->toBe($category->id);
});



it('an event can have many attendees', function () {
    $event = Event::factory()->create();
    $users = User::factory(3)->create();

    foreach($users as $user){
        $event->attendees()->attach($user->id, [
            'status' => 'registered'
        ]);
    }

    expect($event->attendees)->toHaveCount(3);
    $event->attendees->each(fn($user) => expect($user)->toBeInstanceOf(User::class));
});


// it('an event can have many comments', function () {
//     $event = Event::factory()->create();
//     $event->comments->create([
//         'user_id' => $event->organizer->id,
//         'event_id' => $event->id,

//         'content' => fake()->sentence()
//     ]);



//     $event->comments->each(fn($comment) => expect($comment)->toBeInstanceOf(Comment::class));

//     $event->comments->each(
//         fn($comment) => expect($event->id)->toBe($comment->event_id));


    
//     // expect($event->comment)
// });


it('an event can have many comments', function () {
    $event = Event::factory()->create();
    $comments = Comment::factory(3)->create([
        'event_id' => $event->id,
        'content' => fake()->sentence()

    ]);

    expect($event->comments)->toHaveCount(3);
    $event->comments->each(fn($comment) => expect($comment)->toBeInstanceOf(Comment::class));
});


it('an event can have many images', function () {
    $event = Event::factory()->create();
    $images = Image::factory(3)->create([
        'event_id' => $event->id,
        'image_path' => fake()->imageUrl(600, 400, 'nature')
    ]);
    expect($event->images)->toHaveCount(3);
    $event->images->each(fn($image) => expect($image)->toBeInstanceOf(Image::class));
});

