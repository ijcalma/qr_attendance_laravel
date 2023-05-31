<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Student;
use App\Models\EventAttendance;
use Illuminate\Http\Request;


class EventController extends Controller
{
    public function events_all()
    {
        $events = Event::all();

        return view('events.index', compact('events'));
    }
    public function index(Request $request)
    {
        $event_id = $request->input('event_id', '');
        $result_per_page = 10;

        $resultRows = EventAttendance::where('eventid', $event_id)->count();

        $number_of_page = ceil($resultRows / $result_per_page);

        $page = $request->input('page', 1);
        $first_page_number = ($page - 1) * $result_per_page;

        $records = EventAttendance::join('student_info', 'event_attendance.studentid', '=', 'student_info.id')
            ->join('events', 'event_attendance.eventid', '=', 'events.event_id')
            ->where('events.event_id', $event_id)
            ->orderBy('lastname', 'ASC')
            ->select('event_name', 'studentid', 'firstname', 'lastname', 'timein_no', 'timeout_no', 'event_total_absents')
            ->offset($first_page_number)
            ->limit($result_per_page)
            ->get();

        $events = Events::all();

        return view('index', ['records' => $records, 'events' => $events, 'event_id' => $event_id, 'number_of_page' => $number_of_page]);
    }
    public function event_index(Request $request)
    {
        $event_id = $request->input('event_id', '');
        $result_per_page = 10;

        $resultRows = EventAttendance::where('eventid', $event_id)->count();

        $number_of_page = ceil($resultRows / $result_per_page);

        $page = $request->input('page', 1);
        $first_page_number = ($page - 1) * $result_per_page;

        $records = EventAttendance::join('student_info', 'event_attendance.studentid', '=', 'student_info.id')
            ->join('events', 'event_attendance.eventid', '=', 'events.event_id')
            ->where('events.event_id', $event_id)
            ->orderBy('lastname', 'ASC')
            ->select('event_name', 'studentid', 'firstname', 'lastname', 'timein_no', 'timeout_no', 'event_total_absents')
            ->offset($first_page_number)
            ->limit($result_per_page)
            ->get();

        $events = Events::all();

        return view('event_index', ['records' => $records, 'events' => $events, 'event_id' => $event_id, 'number_of_page' => $number_of_page]);
    }

    public function events(Request $request)
    {
        $result_per_page = 10;
        $search = $request->input('search', '');

        $query = Events::query();
        $query->orderBy('event_name', 'ASC');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('event_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('event_id', 'LIKE', '%' . $search . '%')
                    ->orWhere('type', 'LIKE', '%' . $search . '%')
                    ->orWhere('half_day_type', 'LIKE', '%' . $search . '%')
                    ->orWhere('eventdate', 'LIKE', '%' . $search . '%');
            });
        }

        $resultRows = $query->count();
        $number_of_page = ceil($resultRows / $result_per_page);

        $page = $request->input('page', 1);
        $first_page_number = ($page - 1) * $result_per_page;

        $records = $query->offset($first_page_number)
            ->limit($result_per_page)
            ->get();

        return view('events', compact('records', 'number_of_page', 'search'));
    }

    public function create()
    {
        return view('addevent');
    }

    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'event_name' => 'required',
            'type' => 'required',
            'date' => 'required|date',
            'type2' => 'nullable',
        ]);

        // Create new event instance
        $event = new Events();
        $event->event_name = $validatedData['event_name'];
        $event->type = $validatedData['type'];
        $event->eventdate = $validatedData['date'];

        if ($validatedData['type'] == 'Half Day') {
            $event->half_day_type = $validatedData['type2'];
        }

        // Save the event
        $event->save();

        // Redirect to events page
        return redirect()->route('events');
    }
    public function destroy($event_id)
    {
        $event = Events::findOrFail($event_id);
        $event->delete();
        return redirect()->route('events')->with('success', 'Event deleted successfully');
    }
    public function edit($event_id)
    {
        $event = Events::findOrFail($event_id);
        return redirect()->route('editevent', ['eventId' => $event_id]);
    }
    
    public function update(Request $request, $event_id)
{
    $event = Events::findOrFail($event_id);
    $event->event_name = $request->input('event_name');
    $event->type = $request->input('type');
    $event->eventdate = $request->input('date');

    if ($event->type == 'Whole Day') {
        $event->half_day_type = null;
    } elseif ($request->has('type2')) {
        $event->half_day_type = $request->input('type2');
    }

    if ($event->save()) {
        return redirect()->route('events')->with('success', 'Event updated successfully');
    } else {
        return redirect()->back()->with('error', 'Failed to update event')->withInput();
    }
    }

}
