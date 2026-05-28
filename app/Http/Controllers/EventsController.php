<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Inertia\Inertia;

class EventsController extends Controller
{
    public function show(Events $event)
    {
        return Inertia::render('Event/Show', [
            'event' => $event->only(
                'id',
                'title',
                'start_date',
                'description',
            ),
        ]);
    }

    public function example() {}
}
