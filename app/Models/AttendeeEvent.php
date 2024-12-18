<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendeeEvent extends Model
{
    //
    protected $guarded = [];

    protected $table = 'attendee_event';
    public function status(AttendeeEvent $attendeeEvent){
        return $attendeeEvent->status;
    }

    public function find_record(User $user,Event $event){
        $record = AttendeeEvent::where([
            'user_id' => $user->id,
            'event_id' => $event->id
        ]);

        return $record->id;
    }
}






