<!DOCTYPE html>
<html>
<head>
    <title>QR Attendance System</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
</head>
<body style="font-family: sans-serif;">
    @include('navbar')
    </nav> 
    <div class="container">
        <form method="POST" action="{{ route('update_event', $event['event_id'])}}" class="addform">
            @csrf
            @method('PUT')
            <b> Enter Event Name: <br></b>
            <input type="text" name="event_name" value="{{ $event->event_name }}"> <br><br>
            <b>Type:</b>
            <select id="type" name="type">
                <option value="none" selected disabled hidden>Type:</option>
                <option id="Whole Day" value="Whole Day" {{ $event->type == 'Whole Day' ? 'selected' : '' }}>Whole Day</option>
                <option id="Half Day" value="Half Day" {{ $event->type == 'Half Day' ? 'selected' : '' }}>Half Day</option>
            </select>
            <br><br>
            <div id="type2-container" style="display:none;">
                <label for="type2"><b>Half Day Type:</b></label>
                <select id="type2" name="type2">
                    <option value="none" selected disabled hidden>Choose...</option>
                    <option value="Morning" {{ $event->half_day_type == 'Morning' ? 'selected' : '' }}>Morning</option>
                    <option value="Afternoon" {{ $event->half_day_type == 'Afternoon' ? 'selected' : '' }}>Afternoon</option>
                </select>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(function() {
                    $('#type').change(function(){
                        if ($(this).val() == 'Half Day') {
                            $('#type2-container').show();
                        } else {
                            $('#type2-container').hide();
                        }
                    });
                });
            </script>

            <br><br>
            <b> Event Date: <br></b>
            <input type="date" id="date" name="date" value="{{ $event->eventdate }}">
            <br><br>
            <button name="submit" id="submits" value="Submit" class="submit">Submit</button>
        </form>
    </div>
</body>
</html>
