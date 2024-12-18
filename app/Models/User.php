<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'profile'
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }



    // Organizers

    public function organizedEvents()
    {
        return $this->hasMany(Event::class);
    }

    // Attendees
    public function attendedEvents()
    {
        return $this->belongsToMany(Event::class, 'attendee_event')
                    ->withPivot('status')
                    // ->wherePivot('status','registered')
                    ->withTimestamps()
                    ->orderBy('attendee_event.id', 'desc');
    }


    public function registeredAttendedEvents()
    {
        return $this->belongsToMany(Event::class, 'attendee_event')
                    ->withPivot('status')
                    ->wherePivot('status','registered')
                    ->withTimestamps()
                    ->orderBy('attendee_event.id', 'desc');
    }

    
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasAnyRole(array $roles)
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }





}
