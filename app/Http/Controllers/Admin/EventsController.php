<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessaging\Flasher;
use App\Http\Requests\EventFormRequest;
use App\Occasions\Event;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EventsController extends Controller
{
    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function index()
    {
        $events = Event::upcoming();

        return view('admin.events.index')->with(compact('events'));
    }

    public function create()
    {
        $event = new Event;
        return view('admin.events.create')->with(compact('event'));
    }

    public function store(EventFormRequest $request)
    {
        Event::create($request->only(['title', 'event_date', 'event_time', 'description', 'event_location']));

        $this->flasher->success('Event Created', 'The event was created successfully');

        return redirect('admin/events');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit')->with(compact('event'));
    }

    public function update(EventFormRequest $request, Event $event)
    {
        $event->update($request->only(['title', 'event_date', 'event_time', 'description', 'event_location']));

        $this->flasher->success('Saved', 'The event was updated successfully');

        return redirect('admin/events');
    }

    public function delete(Event $event)
    {
        $event->delete();

        $this->flasher->success('Gone!', 'The event has been deleted');

        return redirect('admin/events');
    }
}
