<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
        return response(Event::all()->toArray());
    }

    public function store(Event $event) {
        $data = $event->create(
            request()->validate([
                'name' => 'required|min:3',
                'from' => 'required|date|after:yesterday',
                'to' => 'required|date|after_or_equal:from'
            ])
        );

        return response($data->toArray(), 201);
    }
}
