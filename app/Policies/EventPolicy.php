<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Event;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class EventPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        // if($user->can('is_event_approved', $event)){
        //     return false;
        // }

        // Users can change there events status as an attendee
        if ($event->attendees()->where('user_id', $user->id)->exists()) {
            return true;
        }
        return false;
    }


    // Determine if a user can attend an event
    public function attend(User $user, Event $event):bool 
    {
        // Users can attend an events if they didn't before 
        if ($event->attendees()->where('user_id', $user->id)->exists()) {
            return false;
        }
        // if($event->status != 'approved'){
        //     return false;
        // }
        return true;
    }


    public function re_register(User $user, Event $event){
        // users can remove there cancellation on events by re-registering 
        // if($event->status != 'approved'){
        //     return false;
        // }
        if ($event->attendees()
                ->where('user_id', $user->id)
                ->wherePivot('status', 'cancelled') 
                ->exists()) {
            return true;
        }


        return false;
    }


        // a policy to check if the event is his own or others
    // Own = True, Others = False
    public function is_organizer(User $user, Event $event){
        // Users can not attend there own events
        return $event->user_id == $user->id;
    }

    public function is_not_organizer(User $user, Event $event){
        return $event->user_id != $user->id;
    }
    

    public function is_organizer_or_admin(User $user, Event $event){
        // Users can not attend there own events
        return ($event->user_id == $user->id) || ($user->hasRole('admin'));
    }

    

    public function is_event_approved(User $user, Event $event)
    {
        return $event->status == 'approved';
    }


    // can view the event if the user is the organizer of the event or the user is an admin (applies for organizer and admin)or the event is approved(this applies for public users)
    public function view_event(User $user, Event $event){
        
        return $user->can('is_event_approved', $event) || $user->can('is_organizer_or_admin', $event);

        // return false;
    }


}



