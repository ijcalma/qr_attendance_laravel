<!DOCTYPE html>
<html>
<head>
    <title>QR Attendance System</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body style="font-family: sans-serif;">
    @include('navbar')
    <form action="{{ url()->current() }}" method="GET" class="form">
        <input type="text" name="search" class="search" required />
        <input type="submit" value="Search" style="background-color: grey; padding: 8px; border-radius: 10px; color: white; border: none;">
    </form>
    </nav>
    <div class="container">
        <button type="submit" class="add_student"><a href="{{ route('addevent') }}"> Add New Event</a></button>
        <button type="submit" style="float: right; border: solid black 1px; padding: 10px; border-radius: 5px;"><a href="{{ route('index') }}" style="color: black;">Event Attendance</a>
</button>
        <table class="table" border="1">
            <center><h4>Event List</h4></center>
            <thead>
                @if (count($records) > 0)
                    @php $record = $records[0]; @endphp
                    <th>Event ID</th>
                    <th>Event</th>
                    <th>Type</th>
                    <th>Half Day Type</th>
                    <th>Date of Event</th>
                @endif
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        <td>{{ $record['event_id'] }}</td>
                        <td>{{ $record['event_name'] }}</td>
                        <td>{{ $record['type'] }}</td>
                        <td>{{ $record['half_day_type'] }}</td>
                        <td>{{ $record['eventdate'] }}</td>
                        <td>
                        <form action="{{ route('events', ['eventId' => $record->event_id]), 'editevent' }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="time_in" style="margin-right:50px; margin-bottom: -250px;">Edit</button>
                        </form>


                            <form action="{{ route('delete_event', $record->event_id) }}" method="POST" style="margin-top:-19px">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="time_out" style="margin-left:80px;margin-top: -300px; margin-bottom:1px;">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        @for ($page = 1; $page <= $number_of_page; $page++)
            <a href="{{ url()->current() }}?page={{ $page }}" style="margin-right: 5px; padding: 5px; color: black;">{{ $page }}</a>
        @endfor
    </div>
</body>
</html>
