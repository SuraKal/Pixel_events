<?php

namespace App\Http\Controllers\Public;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller {
    //

    public function __invoke( Request $request ) {
        $searched = $request[ 'q' ];

        $events = Event::with( [ 'category', 'organizer' ] )
        ->where( 'name', 'LIKE', '%' . $searched . '%' )
        ->where('status', 'approved')
        ->get();


        // dd($events);
        return view( 'public.search.event-search', [ 
            'events'=>$events,
            'searched' => $searched
        ]);
    }
}

