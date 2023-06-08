<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Student;
use App\Models\EventAttendance;
use App\Models\Attendance;
use App\Models\Notifications;
use App\Models\Notif_Students;

class EventAttendanaceController extends Controller
{
        
    public function timein()
    {
        $events = Events::all(); 
        return view('timein', compact('events'));
    }

    public function timeout()
    {
        $events = Events::all(); 
        return view('timeout', compact('events'));
    }

    public function getTimein(Request $request)
    {
        if ($request->has('submit')) {
            $idnum = $request->input('text');
            $eventid = $request->input('event');
            date_default_timezone_set('Asia/Manila');
            
            $timezone = 'Asia/Manila';
            $date = Carbon::now($timezone)->format('Y-m-d H:i:s');
            $is_morning = (date('H') < 12);

            $event = Events::find($eventid); // Updated model name
            $half_day_type = $event->half_day_type;

            if ($is_morning && $half_day_type != 'Afternoon') {
                $existingAttendance = Attendance::where('student_id', $idnum)
                    ->where('eventid', $eventid)
                    ->first();

                if ($existingAttendance) {
                    if(!$existingAttendance->timein_am){
                        Attendance::where('student_id', $idnum)
                        ->where('eventid', $eventid)
                        ->update(['timein_am' => $date]);
                    }
                    else{
                        return redirect()->route('getTimeout')->with('error2', 'ERROR');
                    }
                } else {
                    $attendance = Attendance::updateOrCreate(
                        ['student_id' => $idnum, 'eventid' => $eventid],
                        ['timein_am' => $date]
                    );                    
                    $notification = Notifications::create([
                        'notification' => "Student $idnum logged in this afternoon.",
                        'created_at' => $date
                    ]);
                    $notif_students = Notif_Students::create([
                        'notif_id' => $notification->idnotification,
                        'students_id' => $idnum
                    ]);

                    $attendanceExists = EventAttendance::where('studentid', $idnum)
                        ->where('eventid', $eventid)
                        ->exists();

                    if ($attendanceExists) {
                        // Fetch event type
                        $event = Events::where('event_id', $eventid)->first();
                        $type = $event->type;

                        // Fetch timein_no and timeout_no
                        $event_attendance = EventAttendance::where('studentid', $idnum)
                            ->where('eventid', $eventid)
                            ->first();

                        if ($event_attendance) {
                            // Update timein_no
                            $event_attendance->timein_no += 1;
                            $event_attendance->save();

                            if ($type == 'Whole Day') {
                                // Update event_total_timein and event_total_timeout
                                $event_attendance->event_total_timein += 2;
                                $event_attendance->event_total_timeout += 2;
                            } elseif ($type == 'Half Day') {
                                $event_attendance->event_total_timein += 1;
                                $event_attendance->event_total_timeout += 1;
                            }
                            // Update event_total_absents
                            $event_attendance->event_total_absents = $event_attendance->event_total_timein + $event_attendance->event_total_timeout - $event_attendance->timein_no - $event_attendance->timeout_no;
                            $event_attendance->save();
                        }
                    } else {
                        $event_attendance = new EventAttendance();
                        $event_attendance->studentid = $idnum;
                        $event_attendance->eventid = $eventid;
                        $event = Events::where('event_id', $eventid)->first();
                        $type = $event->type;
                        $event_attendance->timein_no = 1;
                        $event_attendance->timeout_no = 0;

                        if ($type == 'Whole Day') {
                            $event_attendance->event_total_timein = 2;
                            $event_attendance->event_total_timeout = 2;
                        } elseif ($type == 'Half Day') {
                            $event_attendance->event_total_timein = 1;
                            $event_attendance->event_total_timeout = 1;
                        }

                        // Update event_total_absents
                        $event_attendance->event_total_absents = $event_attendance->event_total_timein + $event_attendance->event_total_timeout - $event_attendance->timein_no - $event_attendance->timeout_no;
                        $event_attendance->save();
                    }
                    return redirect()->route('getTimein')->with('success', 'SUCCESS');
                }
            } elseif (!$is_morning && $half_day_type != 'Morning') {
                $existingAttendance = Attendance::where('student_id', $idnum)
                    ->where('eventid', $eventid)
                    ->first();

                if ($existingAttendance) {
                    if(!$existingAttendance->timein_pm){
                        Attendance::where('student_id', $idnum)
                        ->where('eventid', $eventid)
                        ->update(['timein_pm' => $date]);
                    }
                    else{
                        return redirect()->route('getTimeout')->with('error2', 'ERROR');
                    }
                } else {
                    $attendance = Attendance::updateOrCreate(
                        ['student_id' => $idnum, 'eventid' => $eventid],
                        ['timein_pm' => $date]
                    );                    
                    $notification = Notifications::create([
                        'notification' => "Student $idnum logged in this afternoon.",
                        'created_at' => $date
                    ]);
                    $notif_students = Notif_Students::create([
                        'notif_id' => $notification->idnotification,
                        'students_id' => $idnum
                    ]);

                    $attendanceExists = EventAttendance::where('studentid', $idnum)
                        ->where('eventid', $eventid)
                        ->exists();

                    if ($attendanceExists) {
                        // Fetch event type
                        $event = Events::where('event_id', $eventid)->first();
                        $type = $event->type;

                        // Fetch timein_no and timeout_no
                        $event_attendance = EventAttendance::where('studentid', $idnum)
                            ->where('eventid', $eventid)
                            ->first();

                        if ($event_attendance) {
                            // Update timein_no
                            $event_attendance->timein_no += 1;
                            $event_attendance->save();

                            if ($type == 'Whole Day') {
                                // Update event_total_timein and event_total_timeout
                                $event_attendance->event_total_timein += 2;
                                $event_attendance->event_total_timeout += 2;
                            } elseif ($type == 'Half Day') {
                                $event_attendance->event_total_timein += 1;
                                $event_attendance->event_total_timeout += 1;
                            }
                            // Update event_total_absents
                            $event_attendance->event_total_absents = $event_attendance->event_total_timein + $event_attendance->event_total_timeout - $event_attendance->timein_no - $event_attendance->timeout_no;
                            $event_attendance->save();
                        }
                    } else {
                        $event_attendance = new EventAttendance();
                        $event_attendance->studentid = $idnum;
                        $event_attendance->eventid = $eventid;
                        $event = Events::where('event_id', $eventid)->first();
                        $type = $event->type;
                        $event_attendance->timein_no = 1;
                        $event_attendance->timeout_no = 0;

                        if ($type == 'Whole Day') {
                            $event_attendance->event_total_timein = 2;
                            $event_attendance->event_total_timeout = 2;
                        } elseif ($type == 'Half Day') {
                            $event_attendance->event_total_timein = 1;
                            $event_attendance->event_total_timeout = 1;
                        }

                        // Update event_total_absents
                        $event_attendance->event_total_absents = $event_attendance->event_total_timein + $event_attendance->event_total_timeout - $event_attendance->timein_no - $event_attendance->timeout_no;
                        $event_attendance->save();
                    }

                }
            }
            return redirect()->route('getTimein')->with('success', 'SUCCESS');
        }
    }

    public function getTimeOut(Request $request)
    {
        if ($request->has('submit')) {
            $idnum = $request->input('text');
            $eventid = $request->input('event');
            date_default_timezone_set('Asia/Manila');
            
            $timezone = 'Asia/Manila';
            $date = Carbon::now($timezone)->format('Y-m-d H:i:s');
            $is_morning = (date('H') < 12);

            $event = Events::find($eventid); // Updated model name
            $half_day_type = $event->half_day_type;

            if ($is_morning && $half_day_type != 'Afternoon') {
                $existingAttendance = Attendance::where('student_id', $idnum)
                ->where('eventid', $eventid)
                ->first();

            if ($existingAttendance) {
                if(!$existingAttendance->timeout_am){
                    Attendance::where('student_id', $idnum)
                    ->where('eventid', $eventid)
                    ->update(['timeout_am' => $date]);
                }
                else{
                    return redirect()->route('getTimeout')->with('error2', 'ERROR');
                }
            } else {
                $attendance = Attendance::updateOrCreate(
                    ['student_id' => $idnum, 'eventid' => $eventid],
                    ['timeout_am' => $date]
                );                    
                $notification = Notifications::create([
                    'notification' => "Student $idnum logged in this afternoon.",
                    'created_at' => $date
                ]);
                $notif_students = Notif_Students::create([
                    'notif_id' => $notification->idnotification,
                    'students_id' => $idnum
                ]);

                $attendanceExists = EventAttendance::where('studentid', $idnum)
                    ->where('eventid', $eventid)
                    ->exists();

                if ($attendanceExists) {
                    // Fetch event type
                    $event = Events::where('event_id', $eventid)->first();
                    $type = $event->type;

                    // Fetch timein_no and timeout_no
                    $event_attendance = EventAttendance::where('studentid', $idnum)
                        ->where('eventid', $eventid)
                        ->first();

                    if ($event_attendance) {
                        // Update timein_no
                        $event_attendance->timein_no += 1;
                        $event_attendance->save();

                        if ($type == 'Whole Day') {
                            // Update event_total_timein and event_total_timeout
                            $event_attendance->event_total_timein += 2;
                            $event_attendance->event_total_timeout += 2;
                        } elseif ($type == 'Half Day') {
                            $event_attendance->event_total_timein += 1;
                            $event_attendance->event_total_timeout += 1;
                        }
                        // Update event_total_absents
                        $event_attendance->event_total_absents = $event_attendance->event_total_timein + $event_attendance->event_total_timeout - $event_attendance->timein_no - $event_attendance->timeout_no;
                        $event_attendance->save();
                    }
                } else {
                    $event_attendance = new EventAttendance();
                    $event_attendance->studentid = $idnum;
                    $event_attendance->eventid = $eventid;
                    $event = Events::where('event_id', $eventid)->first();
                    $type = $event->type;
                    $event_attendance->timein_no = 1;
                    $event_attendance->timeout_no = 0;

                    if ($type == 'Whole Day') {
                        $event_attendance->event_total_timein = 2;
                        $event_attendance->event_total_timeout = 2;
                    } elseif ($type == 'Half Day') {
                        $event_attendance->event_total_timein = 1;
                        $event_attendance->event_total_timeout = 1;
                    }

                    // Update event_total_absents
                    $event_attendance->event_total_absents = $event_attendance->event_total_timein + $event_attendance->event_total_timeout - $event_attendance->timein_no - $event_attendance->timeout_no;
                    $event_attendance->save();
                }

                return redirect()->route('getTimeout')->with('success2', 'SUCCESS');
            }
            } elseif (!$is_morning && $half_day_type != 'Morning') {
                $existingAttendance = Attendance::where('student_id', $idnum)
                    ->where('eventid', $eventid)
                    ->first();
                if ($existingAttendance) {
                    if(!$existingAttendance->timeout_pm){
                        Attendance::where('student_id', $idnum)
                        ->where('eventid', $eventid)
                        ->update(['timeout_pm' => $date]);
                    }
                    else{
                        return redirect()->route('getTimeout')->with('error2', 'ERROR');
                    }
                } else {
                    $attendance = Attendance::updateOrCreate(
                        ['student_id' => $idnum, 'eventid' => $eventid],
                        ['timeout_pm' => $date]
                    );                    
                    $notification = Notifications::create([
                        'notification' => "Student $idnum logged out this afternoon.",
                        'created_at' => $date
                    ]);
                    $notif_students = Notif_Students::create([
                        'notif_id' => $notification->idnotification,
                        'students_id' => $idnum
                    ]);

                    $attendanceExists = EventAttendance::where('studentid', $idnum)
                        ->where('eventid', $eventid)
                        ->exists();

                    if ($attendanceExists) {
                        // Fetch event type
                        $event = Events::where('event_id', $eventid)->first();
                        $type = $event->type;

                        // Fetch timein_no and timeout_no
                        $event_attendance = EventAttendance::where('studentid', $idnum)
                            ->where('eventid', $eventid)
                            ->first();

                        if ($event_attendance) {
                            // Update timein_no
                            $event_attendance->timein_no += 1;
                            $event_attendance->save();

                            if ($type == 'Whole Day') {
                                // Update event_total_timein and event_total_timeout
                                $event_attendance->event_total_timein += 2;
                                $event_attendance->event_total_timeout += 2;
                            } elseif ($type == 'Half Day') {
                                $event_attendance->event_total_timein += 1;
                                $event_attendance->event_total_timeout += 1;
                            }
                            // Update event_total_absents
                            $event_attendance->event_total_absents = $event_attendance->event_total_timein + $event_attendance->event_total_timeout - $event_attendance->timein_no - $event_attendance->timeout_no;
                            $event_attendance->save();
                        }
                    } else {
                        $event_attendance = new EventAttendance();
                        $event_attendance->studentid = $idnum;
                        $event_attendance->eventid = $eventid;
                        $event = Events::where('event_id', $eventid)->first();
                        $type = $event->type;
                        $event_attendance->timein_no = 1;
                        $event_attendance->timeout_no = 0;

                        if ($type == 'Whole Day') {
                            $event_attendance->event_total_timein = 2;
                            $event_attendance->event_total_timeout = 2;
                        } elseif ($type == 'Half Day') {
                            $event_attendance->event_total_timein = 1;
                            $event_attendance->event_total_timeout = 1;
                        }

                        // Update event_total_absents
                        $event_attendance->event_total_absents = $event_attendance->event_total_timein + $event_attendance->event_total_timeout - $event_attendance->timein_no - $event_attendance->timeout_no;
                        $event_attendance->save();
                    }

                }
            }
            return redirect()->route('getTimeout')->with('success2', 'SUCCESS');
        }
    }
            }
