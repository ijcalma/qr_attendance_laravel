<!DOCTYPE html>
<html>
<head>
    <title>QR Attendance System</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body style="font-family: sans-serif;">
    @include('navbar')
    </nav>
    <div class="container">
        <button type="submit" class="add_student">
            <a href="{{ route('addstudent') }}"> Add New Student</a>
        </button>
        <div class="time">
            <button type="submit" class="time_in">
                <a href> Time-in</a>
            </button>

            <button type="submit" class="time_out">
                <a href>Time-out</a>
            </button>
        </div>
        
        <table class="table" border="1">
            <h4 class="label">Students List</h4>
            <form action="{{ url()->current() }}" method="GET" class="form">
                <select name="event_id" class="select" required style="padding: 8px";>
                    <option value="">Select Event</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->event_id }}" @if ($event_id == $event->event_id) selected @endif>
                            {{ $event->event_name }}
                        </option>
                    @endforeach
                </select>
                <input type="submit" value="Search" style="background-color: grey; padding: 8px; border-radius: 10px; color: white; border: none; margin-bottom: 15px; margin-left: 5px;">
            </form>
            <thead>
                <th>Events</th>
                <th>Student Name</th>
                <th>Time-in Number:</th>
                <th>Time-out Number:</th>
                <th>Absents:</th>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        <td>{{ $record->event_name }}</td>
                        <td>{{ $record->lastname }}, {{ $record->firstname }}</td>
                        <td>{{ $record->timein_no }}</td>
                        <td>{{ $record->timeout_no }}</td>
                        <td>{{ $record->event_total_absents }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table><br>
        @for ($page = 1; $page <= $number_of_page; $page++)
            <a href="{{ url()->current() }}?event_id={{ $event_id }}&page={{ $page }}" style="margin-right: 5px; padding: 5px; color: black;">{{ $page }}</a>
        @endfor
    </div>
</body>
</html>
